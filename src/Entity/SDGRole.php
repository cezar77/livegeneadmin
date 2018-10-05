<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SDGRoleRepository")
 * @UniqueEntity(
 *     fields={"project", "sdg"}
 * )
 * @CustomAssert\Percent()
 * @CustomAssert\Percent()
 */
class SDGRole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="SDGRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SDG", inversedBy="SDGRoles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sdg;

    /**
     * @ORM\Column(type="integer")
     */
    private $percent;

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

    public function getSdg(): ?SDG
    {
        return $this->sdg;
    }

    public function setSdg(?SDG $sdg): self
    {
        $this->sdg = $sdg;

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
}
