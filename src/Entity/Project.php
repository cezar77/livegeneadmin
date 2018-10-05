<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @UniqueEntity("ilriCode")
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
     * @Assert\NotBlank()
     */
    private $ilriCode;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank()
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $shortName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $principalInvestigator;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     */
    private $projectsGroup;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $donorReference;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $donorProjectName;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getStartDate() < this.getEndDate()",
     *     message="The end date must be after the start date"
     * )
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "The value must be at least {{ limit }}.",
     *      maxMessage = "The value must not be greater than {{ limit }}."
     * )
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "The value must be at least {{ limit }}.",
     *      maxMessage = "The value must not be greater than {{ limit }}."
     * )
     */
    private $capacityDevelopment;

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

    public function __toString()
    {
        return $this->fullName ? $this->fullName : 'New Organisation';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIlriCode(): ?string
    {
        return $this->ilriCode;
    }

    public function setIlriCode(string $ilriCode): self
    {
        $this->ilriCode = $ilriCode;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getPrincipalInvestigator(): ?Staff
    {
        return $this->principalInvestigator;
    }

    public function setPrincipalInvestigator(?Staff $principalInvestigator): self
    {
        $this->principalInvestigator = $principalInvestigator;

        return $this;
    }

    public function getProjectsGroup(): ?string
    {
        return $this->projectsGroup;
    }

    public function setProjectsGroup(string $projectsGroup): self
    {
        $this->projectsGroup = $projectsGroup;

        return $this;
    }

    public function getDonorReference(): ?string
    {
        return $this->donorReference;
    }

    public function setDonorReference(?string $donorReference): self
    {
        $this->donorReference = $donorReference;

        return $this;
    }

    public function getDonorProjectName(): ?string
    {
        return $this->donorProjectName;
    }

    public function setDonorProjectName(?string $donorProjectName): self
    {
        $this->donorProjectName = $donorProjectName;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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
        return $this->capacityDevelopment;
    }

    public function setCapacityDevelopment(int $capacityDevelopment): self
    {
        $this->capacityDevelopment = $capacityDevelopment;

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
