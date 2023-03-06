<?php

namespace App\Controller;

use App\Repository\OpeningHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpeningHoursController extends AbstractController
{

    // Action pour afficher les horaires
    #[Route('/hours', name: 'app_hours')]
    public function displayHours(OpeningHoursRepository $openingHoursRepository): Response
    {
        // Récupère et affiche les horaires en base de données
        $hours = $openingHoursRepository->findAll();
        return $this->render('headerfooter/footer.html.twig', [
            'hours' => $hours,
        ]);
    }
}