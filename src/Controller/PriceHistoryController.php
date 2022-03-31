<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceHistoryController extends AbstractController
{
    /**
     * @Route("/price_history/", name="price_history", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('price_history.html.twig');
    }

}