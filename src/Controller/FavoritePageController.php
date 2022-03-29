<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritePageController extends AbstractController
{
    /**
     * @Route("/favorite_page/", name="favorite_page", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('favorite_page.html.twig');
    }

}