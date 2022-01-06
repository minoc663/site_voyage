<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }
    
    /**
     * @Route("/account/password", name="account_password")
     */
    public function passwordReset(Request $request): Response
        {
            $user = $this->getUser();
            $form = $this->createForm(ResetPasswordType::class,$user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $newPwd = $form->get('password')->getData();
                $user->setPassword(
                 
                        $this->passwordHasher->hashPassword($user, $newPwd)
                );
            $this->entityManager->flush();
            }

        return $this->render('account_password/account_password.html.twig', [
            'controller_name' => 'AccountPasswordController',
        ]);
    }
}
