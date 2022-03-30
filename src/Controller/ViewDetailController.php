<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewDetailController extends AbstractController
{
    /**
     * @Route("/view_detail", name="view_detail", methods={"GET"})
     */
    public function home() : Response
    {
        return $this->render('view_detail.html.twig');
    }

}