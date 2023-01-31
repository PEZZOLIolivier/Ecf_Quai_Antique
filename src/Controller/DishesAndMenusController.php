<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishesAndMenusController extends AbstractController
{
    #[Route('/dishesandmenus', name: 'app_dishes_and_menus')]
    public function index(): Response
    {
        return $this->render('pages/dishesandmenus.html.twig', [
            'controller_name' => 'DishesAndMenusController',
        ]);
    }
}
