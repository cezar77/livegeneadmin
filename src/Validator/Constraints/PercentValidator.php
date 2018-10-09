<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\StaffRole;

class PercentValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($entity, Constraint $constraint)
    {
        $totalPercent = $entity->getTotalPercent();

        if ($entity instanceof StaffRole) {
            $subject = $entity->getPerson();
        } else {
            $subject = $entity->getProject();
        }

        if ($totalPercent > 100) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ subject }}', $subject)
                ->setParameter('{{ total }}', $totalPercent)
                ->atPath('percent')
                ->addViolation()
            ;
        }
    }
}
