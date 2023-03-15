<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Dessert;
use App\Entity\Menu;
use App\Entity\Starter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;



class DishesAndMenusController extends AbstractController
{
    #[Route('/dishesandmenus', name: 'app_dishes_and_menus')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repoDish = $doctrine->getRepository(Dish::class);
        $resultDish = $repoDish->getAllActiveDish();
        $repoDessert = $doctrine->getRepository(Dessert::class);
        $resultDessert = $repoDessert->getAllActiveDessert();
        $repoStarter = $doctrine->getRepository(Starter::class);
        $resultStarter = $repoStarter->getAllActiveStarter();
        $repoMenu = $doctrine->getRepository(Menu::class);
        $resultMenu = $repoMenu->getAllActiveMenu();


        return $this->render('/pages/dishesandmenus.html.twig', [
            'controller_name' => 'DishesAndMenusController',
            'dishes_dish' => $resultDish,
            'dishes_dessert' => $resultDessert,
            'dishes_starter' => $resultStarter,
            'dishes_menu' => $resultMenu,
        ]);

    }

}
