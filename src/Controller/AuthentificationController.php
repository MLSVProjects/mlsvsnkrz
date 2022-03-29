<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification/", name="authentification", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('authentification.html.twig');
    }

}