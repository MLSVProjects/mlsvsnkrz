<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
/**
* @Route("/product/", name="product_detail", methods={"GET"})
*/
public function home() : Response
{
return $this->render('product_detail.html.twig');
}

/**
 * @Route("/add/{product_id}/{quantity}/", name="add_to_cart")
 */
public function addToCart($product_id, $quantity, CartService $cartService)
{
	$cartService->addToCart($product_id, $quantity);
	//dd($key);
	dd($cartService->getCart());
}

/**
 * @Route("/remove/{product_id}/{quantity}/", name="remove_from_cart")
 */
public function removeFromCart($product_id, $quantity, CartService $cartService)
{
	$cartService->removeFromCart($product_id, $quantity);
	dd($cartService->getCart());
}

/**
 * @Route("/reset/", name="reset_cart")
 */
public function resetCart(CartService $cartService)
{
	$cartService->resetCart();
	dd($cartService->getCart());
}
}