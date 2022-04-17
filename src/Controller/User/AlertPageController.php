<?php

namespace App\Controller\User;

use App\Repository\ProductRepository;
use App\Repository\AlertRepository;
use App\Entity\Alert;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlertPageController extends AbstractController
{
	/**
     * @Route("/addAlert/{id_product}", name="addAlert", methods={"POST"})
     */
    public function addAlert($id_product, Request $request, ManagerRegistry $doctrine, ProductRepository $productRepository, AlertRepository $alertRepository)
    {
		$price = $request->get('price');
		$em = $doctrine->getManager();
		$product = $productRepository->find($id_product);
		$user = $this->getUser();
		$alert = $alertRepository->findOneBy([
			"user"=> $user,
			"product" => $product
		]);

		if ($alert === null) {
			$alert = new Alert();
			$alert->setProduct($product)
				->setUser($user);
		}
        
        $alert->setPrice($price);

		$em->persist($alert);
        $em->flush();
		return $this->redirectToRoute('alerts');
    }

	/**
     * @Route("/removeAlert/{alert_id}", name="removeAlert")
     */
    public function removeAlert($alert_id, Request $request, EntityManagerInterface $entityManager, AlertRepository $alertRepository)
    {
		$alert = $alertRepository->find($alert_id);
		if($alert!==null) {
			$entityManager->remove($alert);
			$entityManager->flush();
		}
		
		return $this->redirectToRoute('alerts');
    }

}