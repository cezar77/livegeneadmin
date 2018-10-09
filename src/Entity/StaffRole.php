<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRoleRepository")
 * @UniqueEntity(
 *     fields={"project", "person"}
 * )
 * @CustomAssert\Percent()
 */
class StaffRole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="staffRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff", inversedBy="staffRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\Column(type="integer")
     */
    private $percent;

    public function __toString()
    {
        return $this->id
            ? sprintf('%s - %s', $this->project, $this->person)
            : 'New StaffRole'
        ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getPerson(): ?Staff
    {
        return $this->person;
    }

    public function setPerson(?Staff $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getTotalPercent(): int
    {
        if (!$this->id) {
            return 0;
        }

        $roles = $this->person->getStaffRoles();
        $totalPercent = 0;
        foreach ($roles as $role) {
            $totalPercent += $role->getPercent();
        }
        return $totalPercent;
    }
}
