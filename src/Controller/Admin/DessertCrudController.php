<?php

namespace App\Controller\Admin;

use App\Entity\Dessert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DessertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return
            Dessert::class;
    }
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', label: 'Nom du dessert');
        yield TextField::new('description', label: 'Déscription');
        yield MoneyField::new('price')
            ->setCurrency('EUR');
        yield AssociationField::new('photo', label: 'Photos');
        yield BooleanField::new('isPublish', label: 'Publié');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInPlural('Desserts')
            ->setEntityLabelInSingular('Dessert');
    }
}
