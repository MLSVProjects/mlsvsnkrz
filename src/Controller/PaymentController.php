<?php

namespace App\Controller;

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
	public function checkout(Request $request, StripeApiService $stripeApiService): Response
	{
		$sessionCart = $request->getSession();

		$cart = [
			[
				'product_id'=>1,
				'quantity'=>2
			],
			[
				'product_id'=>2,
				'quantity'=>1
			]
		];

		$sessionCart->set('cart', $cart);

		$session = $stripeApiService->createCheckout($cart);

		return $this->redirect($session->url, 303);

	}

	#[Route('/success', name: 'success_url')]
	public function successUrl(StripeApiService $stripeApiService, Request $request, OrderService $orderService): Response
	{
		$sessionCart = $request->getSession();
		$cart = $sessionCart->get('cart');
		$session_id = $request->get('session_id');
		$session = $stripeApiService->getCheckoutSession($session_id);
		$orderService->createOrder($cart, $session);
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
