<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partnership;

class PartnershipDatesWithinProjectDatesValidator extends ConstraintValidator
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

        if ($entity->getStartDate() < $entity->getProject()->getStartDate()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ partnershipDate }}', $entity->getStartDate()->format('Y-m-d'))
                ->setParameter('{{ projectDate }}', $entity->getProject()->getStartDate()->format('Y-m-d'))
                ->setParameter('{{ comparator }}', 'before')
                ->atPath('startDate')
                ->addViolation()
            ;
        }

        if ($entity->getEndDate() > $entity->getProject()->getEndDate()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ partnershipDate }}', $entity->getEndDate()->format('Y-m-d'))
                ->setParameter('{{ projectDate }}', $entity->getProject()->getEndDate()->format('Y-m-d'))
                ->setParameter('{{ comparator }}', 'after')
                ->atPath('endDate')
                ->addViolation()
            ;
        }
    }
}
