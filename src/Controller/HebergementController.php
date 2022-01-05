<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Form\HebergementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HebergementController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/hebergement/view", name="hebergement_view")
     */
    public function viewHebergements(Request $request): Response
    {
        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handlerequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hebergement = $form->getData();
            $this->entityManager->persist($hebergement);
            $this->entityManager->flush();

        }

        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();

        return $this->render('hebergement/hebergement.html.twig', [
            'form' => $form->createView(),
            'hebergement' => $hebergement,
            'hebergements' => $hebergements,
        ]);
    }
}
