<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyOrderController extends AbstractController
{
    /**
     * @Route("/my_order/", name="my_order", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('profile/my_order.html.twig');
    }

}