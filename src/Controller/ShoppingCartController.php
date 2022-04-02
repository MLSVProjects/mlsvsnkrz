<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartService;

class ShoppingCartController extends AbstractController
{
    /**
     * @Route("/cart/", name="shopping_cart")
     */
    public function home(ProductRepository $productRepository, CartService $cartService) : Response
    {
		$cart = $cartService->generateCart($productRepository);
		
		//dd($cart);
        return $this->render('shopping_cart.html.twig', ["products"=> $cart]);
    }

}