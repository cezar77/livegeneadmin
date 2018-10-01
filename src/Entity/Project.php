<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ilri_code;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $full_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $short_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $principal_investigator;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $projects_group;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $donor_reference;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $donor_project_name;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity_development;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SDGRole", mappedBy="project")
     */
    private $SDGRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CountryRole", mappedBy="project")
     */
    private $countryRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StaffRole", mappedBy="project")
     */
    private $staffRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partnership", mappedBy="project")
     */
    private $partnerships;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SamplingActivity", mappedBy="project")
     */
    private $samplingActivities;

    public function __construct()
    {
        $this->SDGRoles = new ArrayCollection();
        $this->countryRoles = new ArrayCollection();
        $this->staffRoles = new ArrayCollection();
        $this->partnerships = new ArrayCollection();
        $this->samplingActivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIlriCode(): ?string
    {
        return $this->ilri_code;
    }

    public function setIlriCode(string $ilri_code): self
    {
        $this->ilri_code = $ilri_code;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getPrincipalInvestigator(): ?Staff
    {
        return $this->principal_investigator;
    }

    public function setPrincipalInvestigator(?Staff $principal_investigator): self
    {
        $this->principal_investigator = $principal_investigator;

        return $this;
    }

    public function getProjectsGroup(): ?string
    {
        return $this->projects_group;
    }

    public function setProjectsGroup(string $projects_group): self
    {
        $this->projects_group = $projects_group;

        return $this;
    }

    public function getDonorReference(): ?string
    {
        return $this->donor_reference;
    }

    public function setDonorReference(?string $donor_reference): self
    {
        $this->donor_reference = $donor_reference;

        return $this;
    }

    public function getDonorProjectName(): ?string
    {
        return $this->donor_project_name;
    }

    public function setDonorProjectName(?string $donor_project_name): self
    {
        $this->donor_project_name = $donor_project_name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCapacityDevelopment(): ?int
    {
        return $this->capacity_development;
    }

    public function setCapacityDevelopment(int $capacity_development): self
    {
        $this->capacity_development = $capacity_development;

        return $this;
    }

    /**
     * @return Collection|SDGRole[]
     */
    public function getSDGRoles(): Collection
    {
        return $this->SDGRoles;
    }

    public function addSDGRole(SDGRole $sDGRole): self
    {
        if (!$this->SDGRoles->contains($sDGRole)) {
            $this->SDGRoles[] = $sDGRole;
            $sDGRole->setProject($this);
        }

        return $this;
    }

    public function removeSDGRole(SDGRole $sDGRole): self
    {
        if ($this->SDGRoles->contains($sDGRole)) {
            $this->SDGRoles->removeElement($sDGRole);
            // set the owning side to null (unless already changed)
            if ($sDGRole->getProject() === $this) {
                $sDGRole->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CountryRole[]
     */
    public function getCountryRoles(): Collection
    {
        return $this->countryRoles;
    }

    public function addCountryRole(CountryRole $countryRole): self
    {
        if (!$this->countryRoles->contains($countryRole)) {
            $this->countryRoles[] = $countryRole;
            $countryRole->setProject($this);
        }

        return $this;
    }

    public function removeCountryRole(CountryRole $countryRole): self
    {
        if ($this->countryRoles->contains($countryRole)) {
            $this->countryRoles->removeElement($countryRole);
            // set the owning side to null (unless already changed)
            if ($countryRole->getProject() === $this) {
                $countryRole->setProject(null);
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
            $staffRole->setProject($this);
        }

        return $this;
    }

    public function removeStaffRole(StaffRole $staffRole): self
    {
        if ($this->staffRoles->contains($staffRole)) {
            $this->staffRoles->removeElement($staffRole);
            // set the owning side to null (unless already changed)
            if ($staffRole->getProject() === $this) {
                $staffRole->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partnership[]
     */
    public function getPartnerships(): Collection
    {
        return $this->partnerships;
    }

    public function addPartnership(Partnership $partnership): self
    {
        if (!$this->partnerships->contains($partnership)) {
            $this->partnerships[] = $partnership;
            $partnership->setProject($this);
        }

        return $this;
    }

    public function removePartnership(Partnership $partnership): self
    {
        if ($this->partnerships->contains($partnership)) {
            $this->partnerships->removeElement($partnership);
            // set the owning side to null (unless already changed)
            if ($partnership->getProject() === $this) {
                $partnership->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SamplingActivity[]
     */
    public function getSamplingActivities(): Collection
    {
        return $this->samplingActivities;
    }

    public function addSamplingActivity(SamplingActivity $samplingActivity): self
    {
        if (!$this->samplingActivities->contains($samplingActivity)) {
            $this->samplingActivities[] = $samplingActivity;
            $samplingActivity->setProject($this);
        }

        return $this;
    }

    public function removeSamplingActivity(SamplingActivity $samplingActivity): self
    {
        if ($this->samplingActivities->contains($samplingActivity)) {
            $this->samplingActivities->removeElement($samplingActivity);
            // set the owning side to null (unless already changed)
            if ($samplingActivity->getProject() === $this) {
                $samplingActivity->setProject(null);
            }
        }

        return $this;
    }
}
