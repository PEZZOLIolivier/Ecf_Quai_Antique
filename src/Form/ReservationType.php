<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Repository\OpeningHoursRepository;
use App\Validator\ReservationDate;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservationType extends AbstractType
{
    private $openingHoursRepository;

    public function __construct(OpeningHoursRepository $repo) {
        $this->openingHoursRepository = $repo;
    }

    private function _getOpeningHours() {
        return $this->openingHoursRepository->findAll();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('POST')
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [new ReservationDate($this->_getOpeningHours())]
            ])
            ->add('nbPlaces', IntegerType::class)
            ->add('allergy', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
