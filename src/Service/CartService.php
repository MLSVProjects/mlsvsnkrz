<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{

	private $requestStack;

	public function __construct(RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
	}

	public function getCart(): Array|null
	{
		return $this->requestStack->getSession()->get('cart');
	}

	public function addToCart($product_id, $quantity)
	{
		$session = $this->requestStack->getSession();
		$sessionCart = $session->get('cart');
		if($sessionCart == null) {
			$sessionCart = [];
			$sessionCart[] = [
				'product_id' => $product_id,
				'quantity' => $quantity
			];
		}

		else {
			$key = array_search($product_id, array_column($sessionCart, 'product_id'));
			if($key !== false ) {
				$sessionCart[$key]['quantity'] += $quantity;
			}
			else {
				$sessionCart[] = [
					'product_id' => $product_id,
					'quantity' => $quantity
				];
			}
		}
		$session->set('cart', $sessionCart);
	}

	public function removeFromCart($product_id, $quantity)
	{
		$session = $this->requestStack->getSession();
		$sessionCart = $session->get('cart');

		if($sessionCart != null) {
			$key = array_search($product_id, array_column($sessionCart, 'product_id'));
			if($key !== false) {
				if($sessionCart[$key]['quantity'] <= $quantity) {
					unset($sessionCart[$key]);
				}
				else {
					$sessionCart[$key]['quantity'] -= $quantity;
				}
			}
			$session->set('cart', $sessionCart);
		}
	}

	public function resetCart()
	{
		$session = $this->requestStack->getSession();
		$session->remove('cart');
	}

	public function generateCart(ProductRepository $productRepository): Array
	{
		$products = [];
		foreach($this->getCart() as $cartItem) {
			$product = $productRepository->find($cartItem['product_id']);
			$products[] = [
				'product_id' => $product->getId(),
				'name' => $product->getName(),
				'image' => $product->getImage(),
				'price' => $product->getPrice(),
				'quantity' => $cartItem['quantity']
			];
		}

		return $products;
	}
}