<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VolController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/vol", name="vol")
     */
    public function vol(Request $request): Response
    {

        $vol = new Vol();


        $form = $this->createForm(VolType::class, $vol);


        if ($form->isSubmitted() && $form->isValid()) {

            $vol = $form->getData();

            $this->entityManager->persist($vol);
            $this->entityManager->flush();
        }

        return $this->render('vol/vol.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}