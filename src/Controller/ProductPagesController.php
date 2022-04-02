<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use ContainerLhReKSI\getProductRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPagesController extends AbstractController
{
    /**
     * @Route("/product_pages", name="product_pages", methods={"GET"})
     */
    public function home (ProductRepository $productRepository) : Response
    {
        return $this->render('product/product_pages.html.twig', ["product"=> $productRepository->findAll()]);
    }


}