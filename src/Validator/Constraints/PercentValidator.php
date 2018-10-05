<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\StaffRole;
use App\Entity\CountryRole;
use App\Entity\SDGRole;

class PercentValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($entity, Constraint $constraint)
    {
        if ($entity instanceof StaffRole) {
            $subject = $entity->getPerson();
            $repo = $this->em->getRepository(StaffRole::class);
            $roles = $repo->findByPerson($subject->getId());
        }

        if ($entity instanceof CountryRole) {
            $subject = $entity->getProject();
            $repo = $this->em->getRepository(CountryRole::class);
            $roles = $repo->findByProject($subject->getId());
        }

        if ($entity instanceof SDGRole) {
            $subject = $entity->getProject();
            $repo = $this->em->getRepository(SDGRole::class);
            $roles = $repo->findByProject($subject->getId());
        }

        $totalPercent = 0;
        foreach ($roles as $role) {
            $totalPercent += $role->getPercent();
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
