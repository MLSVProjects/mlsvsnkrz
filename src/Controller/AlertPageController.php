<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Entity\Alert;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlertPageController extends AbstractController
{
    /**
     * @Route("/alert_page/", name="alert_page", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('product/alert_page.html.twig');
    }

	/**
     * @Route("/addAlert/{id_product}", name="addAlert", methods={"POST"})
     */
    public function addAlert($id_product, Request $request, ManagerRegistry $doctrine, ProductRepository $productRepository)
    {
		$price = $request->get('price');
		$em = $doctrine->getManager();
		$product = $productRepository->find($id_product);
		$user = $this->getUser();

        $fav = new Alert();
        $fav->setProduct($product)
		->setUser($user)
        ->setPrice($price);

		$em->persist($fav);
        $em->flush();
		return $this->redirectToRoute('bookmarks');
    }

}