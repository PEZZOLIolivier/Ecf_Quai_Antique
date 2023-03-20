<?php

namespace App\DataFixtures;

use App\Entity\Dessert;
use App\Entity\Dish;
use App\Entity\OpeningHours;
use App\Entity\Photo;
use App\Entity\Starter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $pCesar = new Photo();
        $pCesar>setPictureFile(new File("public/images/photos/salade-cesare-63e64d1627d19507582237.webp"))
            ->setTitle("Salade Césare")
            ->setIsFavorite(true);
        $manager->persist($pCesar);

        $pSaumon = new Photo();
        $pSaumon->setPictureFile(new File("public/images/photos/saumon-fumee-63e64d3049e16492511775.jpg"))
            ->setTitle("Saumon Fumée")
            ->setIsFavorite(false);
        $manager->persist($pSaumon);

        $pRisotto = new Photo();
        $pRisotto->setPictureFile(new File("public/images/photos/risotto-63ea34cd32030251658138.webp"))
            ->setTitle("Risotto")
            ->setIsFavorite(false);
        $manager->persist($pRisotto);

        $pColin = new Photo();
        $pColin->setPictureFile(new File("public/images/photos/colin-bordelaise-63ea354a7f1bf069706175.jpg"))
            ->setTitle("Colin à la bordelaise")
            ->setIsFavorite(true);
        $manager->persist($pColin);

        $pBanana = new Photo();
        $pBanana->setPictureFile(new File("public/images/photos/banana-split-63ea358fa65da241168887.jpg"))
            ->setTitle("Banana Split")
            ->setIsFavorite(true);
        $manager->persist($pBanana);

        $pCitron = new Photo();
        $pCitron->setPictureFile(new File("public/images/photos/tarte-citron-63ea35cd9e279227932227.webp"))
            ->setTitle("Tarte au citron")
            ->setIsFavorite(true);
        $manager->persist($pCitron);

        $manager->flush();

        // TODO : crée tout les plats
        $entree1 = new Starter();
        $entree1->setName("Salade César")
            ->setDescription("Salade gourmande avec poulet, croutons, et copeaux de parmesam AOP")
            ->setPrice(15.00)
            ->setIsPublish(true)
            ->setPhoto($pCesar);
        $manager->persist($entree1);


        $entree2 = new Starter();
        $entree2->setName("Saumon Fumée")
            ->setDescription("Saumon fumé et toasts")
            ->setPrice(20.00)
            ->setIsPublish(false)
            ->setPhoto($pSaumon);
        $manager->persist($entree2);

        $dish1 = new Dish();
        $dish1->setName("Colin à la bordelaise")
            ->setDescription("Filet de colin à la bordelaise avec son riz")
            ->setPrice(15.00)
            ->setIsPublish(false)
            ->setPhoto($pColin);
        $manager->persist($dish1);

        $dish2 = new Dish();
        $dish2->setName("Risotto forestier")
            ->setDescription("Risotto avec son lit de champignons")
            ->setPrice(15.00)
            ->setIsPublish(false)
            ->setPhoto($pRisotto);
        $manager->persist($dish2);

        $dessert1 = new Dessert();
        $dessert1->setName("Banana Split")
            ->setDescription("Un bon banana split maison")
            ->setPrice(15.00)
            ->setIsPublish(false)
            ->setPhoto($pBanana);
        $manager->persist($dessert1);

        $dessert2 = new Dessert();
        $dessert2->setName("Tarte Citron Maison")
            ->setDescription("Une tarte au citron faite maison")
            ->setPrice(15.00)
            ->setIsPublish(false)
            ->setPhoto($pCitron);
        $manager->persist($dessert2);

        $manager->flush();

    }
}
