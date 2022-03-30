<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginPageController extends AbstractController
{
    /**
     * @Route("/Login_page/", name="login_page", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('login_page.html.twig');
    }

}