<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
//    public function index(EntityManagerInterface $entityManager): Response
//    {
//        return $this->render('pages/home.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
//    }
    public function displayPhoto(PhotoRepository $PhotoRepository): Response
    {
        // Récupère et affiche les horaires en base de données
        $photos = $PhotoRepository->findAll();
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'HomeController',
            'photos' => $photos,
        ]);
    }

}
