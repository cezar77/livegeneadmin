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
        $person = $entity->getPerson();
        $repo = $this->em->getRepository(StaffRole::class);
        $roles = $repo->findByPerson($person->getId());

        $totalPercent = 0;
        foreach ($roles as $role) {
            $totalPercent += $role->getPercent();
        }

        if ($totalPercent > 100) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ total }}', $totalPercent)
                ->atPath('percent')
                ->addViolation()
            ;
        }
    }
}
