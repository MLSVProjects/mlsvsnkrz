<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCardController extends AbstractController
{
    /**
     * @Route("/shopping_card/{id}", name="shopping_card", methods={"GET"})
     */
    public function home(ProductRepository $productRepository, $id) : Response
    {
        return $this->render('shopping_card.html.twig', ["product"=> $productRepository->find($id)]);
    }

}