<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HebergementController extends AbstractController
{
    /**
     * @Route("/ajouthebergement", name="hebergement")
     */
    public function hebergement(): Response
    {
        return $this->render('hebergement/hebergement.html.twig', [
            'controller_name' => 'HebergementController',
        ]);
    }
}
