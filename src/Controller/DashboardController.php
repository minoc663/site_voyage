<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Entity\User;
use App\Form\VolType;
use App\Entity\Voyageur;

use App\Form\EditVolType;
use App\Form\RegisterType;
use App\Entity\Hebergement;
use App\Form\HebergementType;
use App\Form\EditRegisterType;
use App\Form\EditHebergementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class DashboardController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $voyageurs = $this->entityManager->getRepository(Voyageur::class)->findAll();
        $vols = $this->entityManager->getRepository(Vol::class)->findAll();
        return $this->render('dashboard/dashboard.html.twig', [
            'hebergements' => $hebergements,
            'users' => $users,
            'voyageurs' => $voyageurs,
            'vols' => $vols
        ]);
    }

    /**
     * @Route("admin/add/user", name="add_user")
     */
    public function addUser(Request $request): Response
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
        }

        return $this->render('dashboard/addUsers.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/edit/user/{id}", name="edit_user")
     */
    public function editUser($id, Request $request): Response
    {

        $users = $this->entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(EditRegisterType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $users->setPassword($this->passwordHasher->hashPassword($users, $users->getPassword()));
            $this->entityManager->persist($users);
            $this->entityManager->flush();
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
        }




        return $this->render('dashboard/editUsers.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/delete/user/{id}", name="delete_user")
     */
    public function deleteUser(User $users, Request $request): Response
    {

        $this->entityManager->remove($users);
        $this->entityManager->flush();
        $this->addFlash('success', 'Membre supprimé !');





        return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
    }

    /**
     * @Route("admin/add/hebergement", name="add_hebergement")
     */
    public function addHebergement(Request $request): Response
    {

        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hebergement = $form->getData();
            $this->entityManager->persist($hebergement);
            $this->entityManager->flush();
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
        }

        return $this->render('dashboard/addhebergement.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/edit/hebergement/{id}", name="edit_hebergement")
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
     *@Route("/admin/delete/hebergement/{id}", name= "hebergement_delete")
     */

    public function deleteHebergement(Hebergement $hebergement): Response

    {
        $this->entityManager->remove($hebergement);
        $this->entityManager->flush();
        $this->addFlash('sucess', 'L\'hebergement a été supprimé avec succès');
        return $this->redirectToRoute('dashboard');
    }


    /**
     * @Route("admin/add/vol", name="add_vol")
     */
    public function addVol(Request $request): Response
    {

        $vol = new Vol();
        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $vol = $form->getData();
            $this->entityManager->persist($vol);
            $this->entityManager->flush();
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
        }

        return $this->render('dashboard/addvol.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/edit/vol/{id}", name="edit_vol")
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
     *@Route("/admin/delete/{id}", name= "vol_delete")
     */

    public function deleteVol(Vol $vol): Response

    {
        $this->entityManager->remove($vol);
        $this->entityManager->flush();
        $this->addFlash('sucess', 'Le vol a été supprimé avec succès');
        return $this->redirectToRoute('dashboard');
    }

        /**
     * @Route("/admin/dashboard/allUsers", name="dashboard_all_users")
     */
    public function viewAllUsers(): Response
    {
       
        $users = $this->entityManager->getRepository(User::class)->findAll();
  
        return $this->render('dashboard/viewEditUser.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/dashboard/allVols", name="dashboard_all_vols")
     */
    public function viewAllVols(): Response
    {
       
        $vols = $this->entityManager->getRepository(Vol::class)->findAll();
  
        return $this->render('dashboard/viewEditVol.html.twig', [
            'vols' => $vols,
        ]);
    }

    /**
     * @Route("/admin/dashboard/allHebergements", name="dashboard_all_hebergements")
     */
    public function viewAllHebergements(): Response
    {
       
        $hebergements = $this->entityManager->getRepository(Hebergement::class)->findAll();
  
        return $this->render('dashboard/viewEditHebergement.html.twig', [
            'hebergements' => $hebergements,
        ]);
    }
}