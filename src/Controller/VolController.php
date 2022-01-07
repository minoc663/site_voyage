<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use App\Repository\VolRepository;
use Container8AfTQ9H\getVolService;
use App\Service\Panier\PanierService;
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
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $vol = $form->getData();

            $this->entityManager->persist($vol);
            $this->entityManager->flush();
        }


        return $this->render('vol/vol.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/vol/{id}", name="vol_detail")
     */
    public function volDetail(VolRepository $volrepository, $id): Response
    {
        $vol = $volrepository->find($id);

        // $singleVol = $this->entityManager->getRepository(Vol::class)->findBy(['id' => $id]);
        return $this->render('vol/singlevol.html.twig', [
            // 'singleVol' => $singleVol,
            'vol' => $vol,


        ]);
    }
     /**
     * @Route("/vols", name="vol_all")
     */
    public function AllVol(VolRepository $volRepository)
    {
        return $this->render('vol/allvol.html.twig', [
            'vols' => $volRepository->findAll()
        ]);
    }


}