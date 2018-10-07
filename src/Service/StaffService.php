<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Staff;


class StaffService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getTotalPercentForStaff(Staff $staff)
    {
        $repository = $this->em->getRepository(Staff::class);
        $person = $repository->findOneById($staff->getId());
        $roles = $person->getStaffRoles();

        $totalPercent = 0;
        foreach ($roles as $role) {
            $totalPercent += $role->getPercent();
        }

        return $totalPercent;
    }
}
