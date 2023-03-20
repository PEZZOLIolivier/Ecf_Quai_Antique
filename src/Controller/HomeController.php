<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function displayPhoto(PhotoRepository $PhotoRepository): Response
    {
        $photos = $PhotoRepository->findAll();
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'HomeController',
            'photos' => $photos,
        ]);
    }

}
