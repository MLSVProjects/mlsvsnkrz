<?php

namespace App\Controller;

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

}