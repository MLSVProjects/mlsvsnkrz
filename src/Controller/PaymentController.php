<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    public function checkout(StripeApiService $stripeApiService, $stripeSK): Response
    {
		$success_url = $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
		$cancel_url = $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL);

		$session = $stripeApiService->createCheckout($stripeSK, $success_url, $cancel_url);

        return $this->redirect($session->url, 303);

    }

    #[Route('/success', name: 'success_url')]
    public function successUrl(): Response
    {
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
