<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlertPageController extends AbstractController
{
    /**
     * @Route("/alert_page/", name="alert_page", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('alert_page.html.twig');
    }

}