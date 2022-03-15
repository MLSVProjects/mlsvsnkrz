<?php

namespace App\Service;

class StripeApiService
{
	public function createCheckout($stripeSK, $success_url, $cancel_url)
	{
		$products = $this->formatProducts();

		\Stripe\Stripe::setApiKey($stripeSK);
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
			'success_url' => $success_url,
			'cancel_url' => $cancel_url,
		]);

		return $checkout;
	}

	public function formatProducts() : Array
	{
		return [
			[
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => 'T-shirt',
					],
					'unit_amount' => 2000,
				],
				'quantity' => 1,
			],
			[
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => 'Jordan 4 x Union LA',
					],
					'unit_amount' => 78200,
				],
				'quantity' => 2,
			]
		];
	}
}
