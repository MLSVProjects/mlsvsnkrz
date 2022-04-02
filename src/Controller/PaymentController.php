<?php

namespace App\Controller;

use App\Service\CartService;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\StripeApiService;

class PaymentController extends AbstractController
{
	#[Route('/payment', name: 'payment')]
	public function index(): Response
	{
		return $this->render('payment/index.html.twig', [
			'controller_name' => 'PaymentController',
		]);
	}

	#[Route('/checkout', name: 'checkout')]
	public function checkout(Request $request, StripeApiService $stripeApiService, CartService $cartService): Response
	{
		$sessionCart = $request->getSession();

		$session = $stripeApiService->createCheckout($cartService->getCart());

		return $this->redirect($session->url, 303);

	}

	#[Route('/success', name: 'success_url')]
	public function successUrl(StripeApiService $stripeApiService, Request $request, OrderService $orderService, CartService $cartService): Response
	{
		$sessionCart = $request->getSession();
		$cart = $sessionCart->get('cart');
		$session_id = $request->get('session_id');
		$session = $stripeApiService->getCheckoutSession($session_id);
		$orderService->createOrder($cart, $session);
		$cartService->resetCart();
		return $this->render('payment/success.html.twig', [
			'controller_name' => 'PaymentController',
		]);
	}

	#[Route('/cancel', name: 'cancel_url')]
	public function cancelUrl(): Response
	{
		return $this->render('payment/cancel.html.twig', [
			'controller_name' => 'PaymentController',
		]);
	}
}
