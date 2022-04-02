<?php

namespace App\Controller;


use App\Entity\Bookmark;
use App\Repository\BookmarkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use function PHPUnit\Framework\equalTo;

class FavoritePageController extends AbstractController
{
    /**
     * @Route("/profil_page/favorite_page/", name="favorite_page", methods={"GET"})
     */
    public function home(BookmarkRepository $bookmarkRepository, ProductRepository $productRepository) : Response
    {
        $id_user = ($this->getUser())->getId();
        return $this->render('favorite_page.html.twig',["productRepository"=>$productRepository,"favoris"=>$bookmarkRepository->findBy(array('user_id' => $id_user))]);
    }

    /**
     * @Route("/addFavorite/{id_product}/{page}", name="addFavorite", methods={"GET"})
     */
    public function addFavorite($id_product, $page, BookMarkRepository $bookMarkRepository, EntityManagerInterface $entityManager, ProductRepository $productRepository) : Response
    {
        $id_user = ($this->getUser())->getId();


        $url = $page == 'products' ? 'http://127.0.0.1:8000/product_pages' : 'http://127.0.0.1:8000/';

        foreach ($bookMarkRepository->findBy(array('user_id' => $id_user)) as $bookmark)
        {
            if ($bookmark->getProductId() == $id_product)
                return new RedirectResponse($url);
        }


        $fav = new Bookmark();
        $fav->setProductId($id_product);
        $fav->setUserId($id_user);
        $fav->setAddedAt(new \DateTimeImmutable());
        $entityManager->persist($fav);
        $entityManager->flush();

        return new RedirectResponse($url);

    }

    /**
     * @Route("/deleteToFavorite/", name="DeleteToFavorite", methods={"GET"})
     */
    public function deleteToFavorite(BookMarkRepository $bookMarkRepository, EntityManagerInterface $entityManager)
    {
    $id = $_GET["id"];

    $fav = $bookMarkRepository->find($id);
    $entityManager->remove($fav);
    $entityManager->flush();

    return $this->redirectToRoute('favorite_page');

    }



}