<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;
use App\Entity\Traits\PersonTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRepository")
 */
class Staff
{
    use PersonTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    private $homeProgram;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="principalInvestigator")
     * @JMS\Exclude()
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StaffRole", mappedBy="person")
     * @JMS\Exclude()
     */
    private $staffRoles;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->staffRoles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id ? sprintf('%s %s', $this->firstName, $this->lastName) : '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getHomeProgram(): ?string
    {
        return $this->homeProgram;
    }

    public function setHomeProgram(string $homeProgram): self
    {
        $this->homeProgram = $homeProgram;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setPrincipalInvestigator($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getPrincipalInvestigator() === $this) {
                $project->setPrincipalInvestigator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StaffRole[]
     */
    public function getStaffRoles(): Collection
    {
        return $this->staffRoles;
    }

    public function addStaffRole(StaffRole $staffRole): self
    {
        if (!$this->staffRoles->contains($staffRole)) {
            $this->staffRoles[] = $staffRole;
            $staffRole->setPerson($this);
        }

        return $this;
    }

    public function removeStaffRole(StaffRole $staffRole): self
    {
        if ($this->staffRoles->contains($staffRole)) {
            $this->staffRoles->removeElement($staffRole);
            // set the owning side to null (unless already changed)
            if ($staffRole->getPerson() === $this) {
                $staffRole->setPerson(null);
            }
        }

        return $this;
    }
}
