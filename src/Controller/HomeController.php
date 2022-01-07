<?php

namespace App\Controller;

use App\Entity\Vol;

use App\Entity\Hebergement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }
    
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();
        
       
        $vols = $this->entityManager->getRepository(Vol::class)->findAll();
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'hebergements' => $hebergements,
            
            
            'vols' => $vols
        ]);
    }

     /**
     * @Route("/redirect", name="redirectToUser")
     */
    public function redirectToUser(): Response
    {
        $role = $this->getUser()->getRole();
      
        switch($role) {
            case "Admin":
                return $this->redirectToRoute('dashboard');
                break;
            case "User":
            return $this->redirectToRoute('account');
            break;

        }
    
    }
}