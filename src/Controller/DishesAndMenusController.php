<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\OpeningHours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;



class DishesAndMenusController extends AbstractController
{
    #[Route('/dishesandmenus', name: 'app_dishes_and_menus')]
    public function index(ManagerRegistry $doctrine): Response
    {
        /*
        $repo = $doctrine->getRepository(Dish::class);
        $all_starters = $repo->findByCategory("Entrée");

        return $this->render('/pages/dishesandmenus.html.twig', [
            'controller_name' => 'DishesAndMenusController',
            'dishes_starters' => $all_starters,
        ]);
        */

//        $repo = $doctrine->getRepository(Dish::class);
//        $all_active_starters = $repo->displayAllActive("True");

        $repo = $doctrine->getRepository(Dish::class);
        $result = $repo->getAllActiveStarter();

        $rep = $doctrine->getRepository(OpeningHours::class);
        //$hours = $rep->sortby([], ['id' => 'asc']);
        $hours =$rep->findAll();

        return $this->render('/pages/dishesandmenus.html.twig', [
            'controller_name' => 'DishesAndMenusController',
            'dishes_starters' => $result,
            'hours' => $hours,
        ]);

    }

}
