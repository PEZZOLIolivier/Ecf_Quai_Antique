<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use App\Controller\Admin\Field\CustomChoiceField;
use App\Entity\Weekday;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use function PHPUnit\Framework\isFalse;


class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horraires')
            ->setEntityLabelInSingular('Horraire');
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
                $weekday,
                BooleanField::new('dayClosed'),
                BooleanField::new('lunchClosed'),
                TimeField::new('lunchStart'),
                TimeField::new('lunchEnd'),
                IntegerField::new('lunchMaxPlaces'),
                BooleanField::new('eveningClosed'),
                TimeField::new('eveningStart'),
                TimeField::new('eveningEnd'),
                IntegerField::new('eveningMaxPlaces'),
            ];
        }

}
