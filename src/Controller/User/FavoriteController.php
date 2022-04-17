<?php

namespace App\Controller\User;


use App\Entity\Bookmark;
use App\Repository\BookmarkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;

class FavoritePageController extends AbstractController
{
    /**
     * @Route("/addFavorite/{id_product}", name="addFavorite", methods={"GET"})
     */
    public function addFavorite($id_product, ManagerRegistry $doctrine, ProductRepository $productRepository)
    {
		$em = $doctrine->getManager();
		$product = $productRepository->find($id_product);
		$user = $this->getUser();

        $fav = new Bookmark();
        $fav->setProductId($product)
		->setUserId($user)
        ->setAddedAt(new \DateTimeImmutable());

		$em->persist($fav);
        $em->flush();
		return $this->redirectToRoute('bookmarks');
    }

    /**
     * @Route("/deleteFromFavorite/{bookmark_id}", name="deleteFromFavorite")
     */
    public function deleteFromFavorite($bookmark_id, BookMarkRepository $bookMarkRepository, EntityManagerInterface $entityManager)
    {
		$fav = $bookMarkRepository->find($bookmark_id);
		if($fav!==null) {
			$entityManager->remove($fav);
			$entityManager->flush();
		}
		
		return $this->redirectToRoute('bookmarks');
    }
}