<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Field\CustomChoiceField;
use App\Entity\TTest;
use App\Entity\Weekday;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class TTestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TTest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $weekday = ChoiceField::new('day')
            ->setFormType(EnumType::class)
            ->setFormTypeOption('class', Weekday::class)
            ->setChoices(Weekday::cases());

        if (Crud::PAGE_INDEX === $pageName || Crud::PAGE_DETAIL === $pageName) {
            $weekday->setChoices(Weekday::getAsArray());
        }

        return [
            TextField::new('name'),
            $weekday,
            IntegerField::new('age')
        ];


    }
}
