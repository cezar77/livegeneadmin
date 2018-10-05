<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PartnershipDatesWithinProjectDates extends Constraint
{
    public $message = 'The partnership dates must be within the project dates. You entered {{ partnershipDate }} which is {{ comparator }} {{ projectDate }}.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
