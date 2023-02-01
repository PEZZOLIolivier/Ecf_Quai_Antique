<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
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
            ->setTitle('Ecf Quai Antique');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Plâts et menus'),
            MenuItem::linkToCrud('Plâts', 'fa fa-tags', Dish::class),
            MenuItem::linkToCrud('Menus', 'fa fa-tags', Menu::class),

            MenuItem::section('Médias'),

            MenuItem::section('Réservations'),

            MenuItem::section('Clients'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-tags', User::class),
        ];
    }
}
