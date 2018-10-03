<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnershipRepository")
 */
class Partnership
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="partnerships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisation", inversedBy="partnerships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partner;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SamplingActivity", mappedBy="partnership")
     */
    private $samplingActivities;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Contact", inversedBy="partnerships")
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartnershipType", inversedBy="partnerships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partnershipType;

    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->samplingActivities = new ArrayCollection();
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

    public function getPartner(): ?Organisation
    {
        return $this->partner;
    }

    public function setPartner(?Organisation $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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
            $samplingActivity->setPartnership($this);
        }

        return $this;
    }

    public function removeSamplingActivity(SamplingActivity $samplingActivity): self
    {
        if ($this->samplingActivities->contains($samplingActivity)) {
            $this->samplingActivities->removeElement($samplingActivity);
            // set the owning side to null (unless already changed)
            if ($samplingActivity->getPartnership() === $this) {
                $samplingActivity->setPartnership(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->contains($contact)) {
            $this->contact->removeElement($contact);
        }

        return $this;
    }

    public function getPartnershipType(): ?PartnershipType
    {
        return $this->partnershipType;
    }

    public function setPartnershipType(?PartnershipType $partnershipType): self
    {
        $this->partnershipType = $partnershipType;

        return $this;
    }
}
