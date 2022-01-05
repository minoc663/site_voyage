<?php

namespace App\Controller;

use App\Entity\Hebergement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SingleHebergementController extends AbstractController
{
    public function __construct(EntityManagerInterface $EntityManager) {
        $this->entityManager = $EntityManager;
    }
    /**
     * @Route("/single/hebergement/{id}", name="single_hebergement")
     */
    public function viewHebergement($id): Response
    {
        $singleHebergement = $this->entityManager->getRepository(Hebergement::class)->findby(['id' => $id]);
        return $this->render('single_hebergement/viewHebergement.html.twig', [
            'singleHebergement' => $singleHebergement,
        ]);
    }
}
