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

class HebergementFormController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/hebergement/form", name="hebergement_form")
     */
    public function viewHebergements(Request $request, SluggerInterface $slugger): Response
    {
        $hebergement = new Hebergement();
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handlerequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hebergement = $form->getData();


            if ($form->get('illustration')->getData()) { //#1
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

            if ($form->get('illustration2')->getData()) { //#2
                $jointFile = $form->get('illustration2')->getData();

            
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

            
                    $hebergement->setIllustration2($newFilename);
                }
            }

            if ($form->get('illustration3')->getData()) {
                $jointFile = $form->get('illustration3')->getData();

            
                if ($jointFile) { //#3
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

            
                    $hebergement->setIllustration3($newFilename);
                }
            }
            
            $this->entityManager->persist($hebergement);
            $this->entityManager->flush();
            $this->addFlash('success', "Hébergement ajouter");
            return $this->redirectToRoute('hebergement_view');

        }


        return $this->render('hebergement_form/hebergementForm.html.twig', [
            'form' => $form->createView(),
            'hebergement' => $hebergement,
            'hebergements' => $hebergements,
        ]);
        
    }
    
}
