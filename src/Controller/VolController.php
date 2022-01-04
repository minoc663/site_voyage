<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolController extends AbstractController
{
    /**
     * @Route("/vol", name="vol")
     */
    public function vol(): Response
    {
        return $this->render('vol/vol.html.twig',);
    }
}