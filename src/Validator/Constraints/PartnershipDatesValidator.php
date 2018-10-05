<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partnership;

class PartnershipDatesValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($entity, Constraint $constraint)
    {
        if (null === $entity->getStartDate() || null === $entity->getEndDate()) {
            return;
        }

        if ($entity->getStartDate() >= $entity->getEndDate()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ startDate }}', $entity->getStartDate()->format('Y-m-d'))
                ->setParameter('{{ endDate }}', $entity->getEndDate()->format('Y-m-d'))
                ->atPath('endDate')
                ->addViolation()
            ;
        }
    }
}
