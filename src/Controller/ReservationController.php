<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $reservation = new Reservation();
        $reservationForm = $this->createForm(ReservationType::class, $reservation);

        $reservationForm->handleRequest($request);

        if( $reservationForm->isSubmitted() && $reservationForm->isValid())
        {
            $manager->persist($reservation);
            $manager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('reservation/reservation.html.twig', ["reservationForm" => $reservationForm->createView()]);
    }



}
