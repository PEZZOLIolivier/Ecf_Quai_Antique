<?php

namespace App\Controller;




use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\OpeningHours;
use Brick\DateTime\LocalDateTime;
use Brick\DateTime\Parser\DateTimeParseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Brick\DateTime\LocalTime;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ReservationsController extends AbstractController
{


    #[Route('/reservations', name: 'app_reservations')]

    public function new(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $reservation = new Reservation();
        $reservation->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash("success", "Voici le numéro de votre réservation: " . $reservation->getId());
        }

        // $this->addFlash("success", "Voici le numéro de votre réservation: " . $reservation->getId());

        return $this->render('pages/reservations.html.twig', [
            'reservationForm' => $form->createView(),

        ]);
    }

    #[Route('/a/reservation_slots', name: 'ajax_get_reservation_slots', methods: ['POST'])]
    public function getReservationSlots(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
//        $res = array("val" => urldecode($request->getContent()));

        try {
            $currentDate = LocalDateTime::parse(json_decode($request->getContent(), true)["currentDate"]);
        } catch (DateTimeParseException $e) {
            $res = array("slots"=>"-");
            return new Response(
                json_encode($res),
                200,
                ["Content-Type" => "application/json;charset=UTF-8"]
            );
        }

        $ohRepo = $doctrine->getManager()->getRepository(OpeningHours::class);
        $openHours = $ohRepo->findAll();
        $oh = array_filter($openHours, function($val) use ($currentDate) {
            return $val->getDay()->name === $currentDate->getDayOfWeek()->__toString();
        });
        $oh = reset($oh);



        $lunchStart = new LocalDateTime($currentDate->getDate(), LocalTime::fromNativeDateTime($oh->getLunchStart()));
        $lunchEnd = new LocalDateTime($currentDate->getDate(), LocalTime::fromNativeDateTime($oh->getLunchEnd()));
        $eveningStart = new LocalDateTime($currentDate->getDate(), LocalTime::fromNativeDateTime($oh->getEveningStart()));
        $eveningEnd = new LocalDateTime($currentDate->getDate(), LocalTime::fromNativeDateTime($oh->getEveningEnd()));

        $maxPlaces = 0;
        $isLunch = false;

        if ($currentDate->isAfterOrEqualTo($lunchStart) && $currentDate->isBefore($lunchEnd->minusHours(1))) {
            // c'est le midi
            $maxPlaces = $oh->getLunchMaxPlaces();
            $isLunch = true;
        } elseif ($currentDate->isAfterOrEqualTo($eveningStart) && $currentDate->isBefore($eveningEnd->minusHours(1))) {
            // c'est le soir
            $maxPlaces = $oh->getEveningMaxPlaces();
        }

        $reservRepo = $doctrine->getManager()->getRepository(Reservation::class);
        $reservations = $reservRepo->getByDateAndService($currentDate->toNativeDateTime(), $oh);
        $rSlots = 0;
        foreach ($reservations as $r) {
            $rSlots += $r->getNbPlaces();
        }

        $slots = $maxPlaces - $rSlots;

        if(($maxPlaces - $rSlots)<0) {
            $slots = 0;
        }

        $res = array("slots"=> strval($slots), "maxPlaces" => strval($maxPlaces), "rSlots" => $rSlots);

        return new Response(
            json_encode($res),
            200,
            ["Content-Type" => "application/json;charset=UTF-8"]
        );
    }



}
