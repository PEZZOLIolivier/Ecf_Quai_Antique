<?php

namespace App\DataFixtures;

use App\Entity\Dessert;
use App\Entity\Dish;
use App\Entity\OpeningHours;
use App\Entity\Photo;
use App\Entity\Starter;
use App\Entity\Weekday;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $mJour = new Photo();
        $mJour->setPicture("plat-du-jour-est-filet-641984f261f08398773992.jpg");
        $mJour->setPictureFile(new File("public/images/photos/plat-du-jour-est-filet-641984f261f08398773992.jpg"));
        $mJour->setTitle("Menu du jour")
            ->setIsFavorite(false);
        $manager->persist($mJour);

        $pCesar = new Photo();
        $pCesar->setPicture("salade-cesare-63e64d1627d19507582237.webp");
        $pCesar->setPictureFile(new File("public/images/photos/salade-cesare-63e64d1627d19507582237.webp"));
        $pCesar->setTitle("Salade Césare")
            ->setIsFavorite(true);
        $manager->persist($pCesar);

        $pSaumon = new Photo();
        $pSaumon->setPicture("saumon-fumee-63e64d3049e16492511775.jpg");
        $pSaumon->setPictureFile(new File("public/images/photos/saumon-fumee-63e64d3049e16492511775.jpg"));
        $pSaumon->setTitle("Saumon Fumée")
            ->setIsFavorite(false);
        $manager->persist($pSaumon);

        $pRisotto = new Photo();
        $pRisotto->setPicture("risotto-63ea34cd32030251658138.webp");
        $pRisotto->setPictureFile(new File("public/images/photos/risotto-63ea34cd32030251658138.webp"));
        $pRisotto->setTitle("Risotto")
            ->setIsFavorite(false);
        $manager->persist($pRisotto);

        $pColin = new Photo();
        $pColin->setPicture("colin-bordelaise-63ea354a7f1bf069706175.jpg");
        $pColin->setPictureFile(new File("public/images/photos/colin-bordelaise-63ea354a7f1bf069706175.jpg"));
        $pColin->setTitle("Colin à la bordelaise")
            ->setIsFavorite(true);
        $manager->persist($pColin);

        $pBanana = new Photo();
        $pBanana->setPicture("banana-split-63ea358fa65da241168887.jpg");
        $pBanana->setPictureFile(new File("public/images/photos/banana-split-63ea358fa65da241168887.jpg"));
        $pBanana->setTitle("Banana Split")
            ->setIsFavorite(true);
        $manager->persist($pBanana);

        $pCitron = new Photo();
        $pCitron->setPicture("tarte-citron-63ea35cd9e279227932227.webp");
        $pCitron->setPictureFile(new File("public/images/photos/tarte-citron-63ea35cd9e279227932227.webp"));
        $pCitron->setTitle("Tarte au citron")
            ->setIsFavorite(true);
        $manager->persist($pCitron);

        $manager->flush();

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

        $menu1 = new Dessert();
        $menu1->setName("Menu Du Jour")
            ->setDescription("Salade + plat du jour")
            ->setPrice(15.00)
            ->setIsPublish(true)
            ->setPhoto($mJour);
        $manager->persist($menu1);

        $manager->flush();

        $lunchStart = new \DateTime('12:00');
        $lunchEnd = new \DateTime('14:00');
        $eveningStart = new \DateTime('20:00');
        $eveningEnd = new \DateTime('23:00');

        $monday = new OpeningHours();
        $monday->setDay(Weekday::Monday)
            ->setDayClosed(true)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($monday);

        $tuesday = new OpeningHours();
        $tuesday->setDay(Weekday::Tuesday)
            ->setDayClosed(false)
            ->setLunchClosed(true)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($tuesday);

        $wednesday = new OpeningHours();
        $wednesday->setDay(Weekday::Wednesday)
            ->setDayClosed(false)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(true)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($wednesday);

        $thursday = new OpeningHours();
        $thursday->setDay(Weekday::Thursday)
            ->setDayClosed(false)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($thursday);

        $friday = new OpeningHours();
        $friday->setDay(Weekday::Friday)
            ->setDayClosed(false)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($friday);

        $saturday = new OpeningHours();
        $saturday->setDay(Weekday::Saturday)
            ->setDayClosed(false)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($saturday);

        $sunday = new OpeningHours();
        $sunday->setDay(Weekday::Sunday)
            ->setDayClosed(false)
            ->setLunchClosed(false)
            ->setLunchStart($lunchStart)
            ->setLunchEnd($lunchEnd)
            ->setLunchMaxPlaces(50)
            ->setEveningClosed(false)
            ->setEveningStart($eveningStart)
            ->setEveningEnd($eveningEnd)
            ->setEveningMaxPlaces(50);
        $manager->persist($sunday);

        $manager->flush();
    }
}
