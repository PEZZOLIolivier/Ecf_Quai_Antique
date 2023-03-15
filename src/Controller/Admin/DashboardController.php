<?php

namespace App\Controller\Admin;

use App\Entity\Dessert;
use App\Entity\Dish;
use App\Entity\Photo;
use App\Entity\OpeningHours;
use App\Entity\Reservation;
use App\Entity\Starter;
use App\Entity\Menu;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]

    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Quai Antique');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Gestion Quai Antique', 'fa-solid fa-chart-simple'),

            MenuItem::section('Horraires & Réservations'),
            MenuItem::linkToCrud('Horraires', 'fa-solid fa-clock', OpeningHours::class),
            MenuItem::linkToCrud('Réservations', 'fa-solid fa-calendar', Reservation::class),


            MenuItem::section('Plâts et menus'),
            MenuItem::linkToCrud('Entrées', 'fa-solid fa-carrot', Starter::class),
            MenuItem::linkToCrud('Plâts', 'fa-solid fa-fish', Dish::class),
            MenuItem::linkToCrud('Desserts', 'fa-solid fa-ice-cream', Dessert::class),
            MenuItem::linkToCrud('Menus', 'fa-solid fa-plate-wheat', Menu::class),

            MenuItem::section('Médias'),
            MenuItem::linkToCrud('Photos', 'fa-regular fa-image', Photo::class),

            MenuItem::section('Clients'),
            MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class),
        ];
    }
}
