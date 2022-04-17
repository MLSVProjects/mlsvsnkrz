<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditProfilController extends AbstractController
{
    /**
     * @Route("/edit_profil", name="edit_profil", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('edit_profil.html.twig');
    }

}