<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilPageController extends AbstractController
{
    /**
     * @Route("/profil_page/", name="profil_page", methods={"GET"})
     */
    public function home () : Response
    {
        return $this->render('profil_page.html.twig');
    }

}