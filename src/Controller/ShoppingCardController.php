<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCardController extends AbstractController
{
    /**
     * @Route("/shopping_card/", name="shopping_card", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('shopping_card.html.twig');
    }

}