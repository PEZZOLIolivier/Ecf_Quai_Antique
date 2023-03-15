<?php
namespace App\Validator;

use App\Entity\OpeningHours;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ReservationDate extends Constraint
{
    public $messageAfter = 'Votre réservation doit se trouver dans les 2 mois à venir.';
    public $messageBefore = 'La date de réservation ne peut pas se trouver dans le passé';
    public $openHours = [];

    #[HasNamedArguments]
    public function __construct($oh, array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
        $this->openHours = $oh;
    }
}