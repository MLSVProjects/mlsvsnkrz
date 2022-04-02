<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeApiService
{

	private $router;
	private $productRepository;

    public function __construct(UrlGeneratorInterface $router, $stripeSK, ProductRepository $productRepository)
    {
		\Stripe\Stripe::setApiKey($stripeSK);
        $this->router = $router;
		$this->productRepository = $productRepository;
    }

	public function createCheckout($cart)
	{
		$products = $this->formatProducts($cart);

		$checkout = \Stripe\Checkout\Session::create([
			'line_items' =>
			$products,
			'mode' => 'payment',
			'shipping_address_collection' => [
				'allowed_countries' => ['US', 'CA', 'FR', 'GB'],
			],
			'shipping_options' => [
				[
					'shipping_rate' => 'shr_1KIcxUEKUqoXpcCctKDlI6rG',
				],
				[
					'shipping_rate' => 'shr_1KIcyvEKUqoXpcCcJjzM9e27',
				],
			],
			'success_url' => $this->router->generate('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL)."?session_id={CHECKOUT_SESSION_ID}",
			'cancel_url' => $this->router->generate('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
		]);

		return $checkout;
	}

	public function formatProducts($cart) : Array
	{
		foreach($cart as $product) {
			$productEntity = $this->productRepository->find($product['product_id']);
			$finalCart[]=[
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => $productEntity->getName(),
					],
					'unit_amount' => floatval($productEntity->getPrice())*100,
				],
				'quantity' => $product['quantity'],
			];
		}
		return $finalCart;
	}

	public function getCheckoutSession($session_id): \Stripe\Checkout\Session
	{
		return \Stripe\Checkout\Session::retrieve($session_id);
	}

	public function getPaymentIntent($payment_intent_id)
	{
		return \Stripe\PaymentIntent::retrieve($payment_intent_id);
	}
}
