<?php

namespace App\Validator;

use Brick\DateTime\LocalTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Brick\DateTime\LocalDateTime;
use Brick\DateTime\TimeZone;

class ReservationDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void {
        if (!$constraint instanceof ReservationDate) {
            throw new UnexpectedTypeException($constraint, NoMoreThanTwoMonthAway::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof \DateTime) {
            throw new UnexpectedValueException($value, 'DateTime');
        }

        $now = LocalDateTime::now(TimeZone::utc());
        $now60j = $now->plusDays(60);
        $d = LocalDateTime::fromNativeDateTime($value);
        $dayOfReservation = $d->getDayOfWeek()->__toString();
        //var_dump($constraint->openHours);
        $oh = array_filter($constraint->openHours, function($val) use ($dayOfReservation) {
            return $val->getDay()->name === $dayOfReservation;
        });

        // j'aurais pu utilisé $oh[0], mais PHP est con ! du coup il faut le patcher
        $oh = reset($oh);

        $t = $d->getTime();

        $lunch_start = LocalTime::fromNativeDateTime($oh->getLunchStart());
        $lunch_end = LocalTime::fromNativeDateTime($oh->getLunchEnd());
        $evening_start = LocalTime::fromNativeDateTime($oh->getEveningStart());
        $evening_end = LocalTime::fromNativeDateTime($oh->getEveningEnd());

        $msg = '';

        // On vérifie que la date de réservation n'est pas dans le passé ou trop loin dans le futur (2 mois hard-coded)
        if ($d->isAfter($now60j)) {
            $msg = $constraint->messageAfter;
        } elseif ($d->isBefore($now)) {
            $msg = $constraint->messageBefore;
        }

        if (strlen($msg) > 0) {
            $this->context->buildViolation($msg)->addViolation();
        }

        // on vérifie que le jour en question n'est pas fermé
        if ($oh->isDayClosed()) {
            $this->context->buildViolation("Restaurant fermé ce jour")->addViolation();
        }

        // on vérifie que l'heure n'est pas avant le début du service du midi
        if ($t->isBefore($lunch_start)) {
            $this->context->buildViolation("Le restaurant est fermé le matin")->addViolation();
        }

        // on vérifie que l'heure n'est pas entre les 2 services
        if ($t->isAfter($lunch_end) && $t->isBefore($evening_start)) {
            $this->context->buildViolation("Le restaurant est fermé entre les 2 services")->addViolation();
        }

        // on vérifie que l'heure n'est pas après le service du soir
        if ($t->isAfter($evening_end)) {
            $this->context->buildViolation("On est parti se coucher")->addViolation();
        }

        if ($t->isAfter($lunch_start) && $t->isBefore($lunch_end)) {
            if ($oh->isLunchClosed()) {
                $this->context->buildViolation("Le restaurant est fermé ce jour le midi")->addViolation();
            }
        }

        if ($t->isAfter($evening_start) && $t->isBefore($evening_end)) {
            if ($oh->isEveningClosed()) {
                $this->context->buildViolation("Le restaurant est fermé ce jour le soir")->addViolation();
            }
        }
    }
}
