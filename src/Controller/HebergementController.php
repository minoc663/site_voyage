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
    public function viewHebergements(Request $request, SluggerInterface $slugger): Response
    {
        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handlerequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hebergement = $form->getData();
            if ($form->get('illustration')->getData()) {
                $jointFile = $form->get('illustration')->getData();

            
                if ($jointFile) {
                    $originalFilename = pathinfo($jointFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $jointFile->guessExtension();

                
                    try {
                        $jointFile->move(
                            $this->getParameter('picture'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    
                    }

            
                    $hebergement->setIllustration($newFilename);
                }
            }
            
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
