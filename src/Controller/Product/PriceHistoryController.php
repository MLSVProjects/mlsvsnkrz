<?php

namespace App\Controller\Product;

use App\Repository\PriceHistoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceHistoryController extends AbstractController
{
    /**
     * @Route("/price_history/{id}", name="price_history", methods={"GET"})
     */
    public function home(ProductRepository $productRepository, $id, PriceHistoryRepository $priceHistoryRepository) : Response
    {
        return $this->render('product/price_history.html.twig', [
			"product"=> $productRepository->find($id),
			"histories" => $priceHistoryRepository->findBy(["product_id"=>$id])
		]);
    }

}