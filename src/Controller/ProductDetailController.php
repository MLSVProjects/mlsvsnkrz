<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
/**
* @Route("/product/{id}", name="product_detail", methods={"GET"})
*/
public function home(ProductRepository $productRepository,$id) : Response
{
return $this->render('product_detail.html.twig', ["product"=> $productRepository->find($id)]);
}

}