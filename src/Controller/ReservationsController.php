<?php

namespace App\Controller;



use App\Entity\OpeningHours;
use App\Entity\Reservation;
use App\Form\ReservationType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

use Symfony\Component\Validator\Constraints as Assert;


class ReservationsController extends AbstractController
{

    #[Route('/reservations', name: 'app_reservations')]
//    public function index(): Response
//    {
//        return $this->render('pages/reservations.html.twig', [
//            'controller_name' => 'ReservationsController',
//        ]);
//    }

    public function new(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $reservation = new Reservation();
        $reservation->setCreatedAt(new \DateTimeImmutable('now'));
        $reservation->setDate(new \DateTime());
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservation);
            $em->flush();
        }

        return $this->render('pages/reservations.html.twig', [
            'reservationForm' => $form->createView(),
        ]);
    }

    protected function createReservationForm($entity)
    {
        $form = $this->createForm($this->new(), $entity, array(
            'action' => $this->generateUrl('app_hours'),
            'method' => 'POST'
        ));
        $form->getData();
        $form->handleRequest($request);

        return $form;
    }

}
