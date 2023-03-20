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
        $oh = array_filter($constraint->openHours, function($val) use ($dayOfReservation) {
            return $val->getDay()->name === $dayOfReservation;
        });

        $oh = reset($oh);

        $t = $d->getTime();

        $lunch_start = LocalTime::fromNativeDateTime($oh->getLunchStart());
        $lunch_end = LocalTime::fromNativeDateTime($oh->getLunchEnd());
        $evening_start = LocalTime::fromNativeDateTime($oh->getEveningStart());
        $evening_end = LocalTime::fromNativeDateTime($oh->getEveningEnd());

        $msg = '';

        // On vérifie que la date est bien comprise entre maintenant et +60 Jours
        if ($d->isAfter($now60j)) {
            $msg = $constraint->messageAfter;
        }

        if ($d->isBefore($now)) {
            $msg = $constraint->messageBefore;
        }

        if (strlen($msg) > 0) {
            $this->context->buildViolation($msg)->addViolation();
        }

        // On vérifie que le restaurant n'est pas fermé le jour de la réservation
        if ($oh->isDayClosed()) {
            $this->context->buildViolation("Le restaurant est fermé ce jour")->addViolation();
        }

        // On vérifie que l'heure de réservation n'est pas en dehors des horraires du restaurant
        if ($t->isBefore($lunch_start) or ($t->isAfter($lunch_end->minusHours(1)) && $t->isBefore($evening_start)) or $t->isAfter($evening_end->minusHours(1))) {
            $this->context->buildViolation("L'heure que vous avez choisi n'est pas comprise dans nos horraires d'ouverture")->addViolation();
        }

        // On vérifie si le restaurant est ouvert ou pas pendant le service
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
