<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class DishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return
            Dish::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', label: 'Nom du plât'),
            TextField::new('description', label: 'Déscription'),
            AssociationField::new('categories', label: 'Catégories'),
            MoneyField::new('price', label: 'Prix')->setCurrency('EUR'),
            AssociationField::new('photos', label: 'Photos')->onlyOnIndex(),
            BooleanField::new('isPublish', label: 'Publié'),
        ];
    }

}
