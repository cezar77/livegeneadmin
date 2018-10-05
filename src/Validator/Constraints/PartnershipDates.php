<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PartnershipDates extends Constraint
{
    public $message = 'The end date must be after the start date. {{ endDate }} is not after {{ startDate }}.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
