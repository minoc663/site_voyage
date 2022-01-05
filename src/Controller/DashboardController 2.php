<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Entity\User;
use App\Entity\Hebergement;
use App\Form\HebergementType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entitymanager = $entityManager;
    }
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findall();
        $users = $this->entityManager->getRepository(User::class)->findall();
        $voyageurs = $this->entityManager->getRepository(Voyageur::class)->findall();
        $vols = $this->entityManager->getRepository(Vol::class)->findall();
        return $this->render('dashboard/dashboard.html.twig', [
            'hebergements' => $hebergements,
            'users' => $users,
            'voyageurs' => $voyageurs,
            'vols' => $vols
        ]);
    }

    /**
     * @Route("/admin/edit/hebergement/{id}, name="edit_hebergement)
     */

    public function editHebergement($id, Request $request): Response
    {
        $hebergement = $this->entityManager->getRepository(Hebergement::class)->find($id);

        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isSubmitted()) {
            $this->entityManager->persist($hebergement);
            $this->entityManager->flush();
        }

        return $this->render('dashboard/editHebergement.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/edit/vol/{id}, name="edit_vol)
     */

    public function editVol($id, Request $request): Response
    {
        $vol = $this->entityManager->getRepository(Vol::class)->find($id);

        $form = $this->createForm(EditVolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isSubmitted()) {
            $this->entityManager->persist($vol);
            $this->entityManager->flush();
        }

        return $this->render('dashboard/editvol.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     *@Route("/admin/delete/{id}, name= "vol_delete")
     */

    public function deleteVol(Vol $vol): Response

    {
        $this->entityManager->remove($vol);
        $this->entityManager->flush();
        $this->addFlash('sucess', 'Le vol a été supprimé avec succès');
        return $this->redirectToRoute('dashboard');
    }

    /**
     *@Route("/admin/delete/user/{id}, name= "user_delete")
     */

    public function deleteUser(User $user): Response

    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this->addFlash('sucess', 'L\'utilisateur a été supprimé avec succès');
        return $this->redirectToRoute('dashboard');
    }

    /**
     *@Route("/admin/delete/hebergement/{id}, name= "hebergement_delete")
     */

    public function deleteHebergement(Hebergement $hebergement): Response

    {
        $this->entityManager->remove($hebergement);
        $this->entityManager->flush();
        $this->addFlash('sucess', 'L\'hebergement a été supprimé avec succès');
        return $this->redirectToRoute('dashboard');
    }
}