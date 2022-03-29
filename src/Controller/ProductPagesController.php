<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPagesController extends AbstractController
{
    /**
     * @Route("/product_pages", name="product_pages", methods={"GET"})
     */
    public function home () : Response
    {
        return $this->render('product_pages.html.twig');
    }

}