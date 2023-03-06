<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $rep = $entityManager->getRepository(OpeningHours::class);
        $hours = $rep->findBy([], ['id' => 'asc']);

        return $this->render('pages/reservations.html.twig', [
            'controller_name' => 'ReservationsController',
            'hours' => $hours
        ]);
    }
}
