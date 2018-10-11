<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnershipRepository")
 * @UniqueEntity(
 *     fields={"project", "partner", "partnershipType"}
 * )
 * @CustomAssert\PartnershipDates()
 * @CustomAssert\PartnershipDatesWithinProjectDates()
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
     * @Assert\Date()
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Contact", inversedBy="partnerships")
     * @Assert\NotBlank()
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

    public function __toString()
    {
        return $this->id
            ? sprintf('%s - %s (%s)', $this->project, $this->partner, $this->partnershipType)
            : 'New Partnership'
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
        if ($this->id) {
            return $this->startDate ? $this->startDate : $this->project->getStartDate();
        } else {
            return $this->startDate;
        }
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        if ($this->id) {
            return $this->endDate ? $this->endDate : $this->project->getEndDate();
        } else {
            return $this->endDate;
        }
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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
