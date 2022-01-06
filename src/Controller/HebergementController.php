<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Form\HebergementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



class HebergementController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/hebergement/view", name="hebergement_view")
     */
    public function hebergementView(Request $request, SluggerInterface $slugger): Response
    {
        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handlerequest($request);
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();
        return $this->render('hebergement/hebergementView.html.twig', [
            'form' => $form->createView(),
            'hebergement' => $hebergement,
            'hebergements' => $hebergements,
        ]);
    }
}