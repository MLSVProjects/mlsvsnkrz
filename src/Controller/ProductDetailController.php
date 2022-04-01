<?php

namespace App\Controller;

use App\Service\CartService;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
/**
* @Route("/product/{id}", name="product_detail")
*/
public function home(ProductRepository $productRepository,$id) : Response
{
return $this->render('product_detail.html.twig', ["product"=> $productRepository->find($id)]);
}

/**
 * @Route("/add/{product_id}/", name="add_to_cart")
 */
public function addToCart($product_id, CartService $cartService)
{
	$cartService->addToCart($product_id, 1);
	//dd($key);
	return $this->redirectToRoute('shopping_cart');
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