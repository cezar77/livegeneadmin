<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SamplingActivityRepository")
 */
class SamplingActivity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="samplingActivities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisation", inversedBy="samplingActivities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partner;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SamplingDocumentation", mappedBy="samplingActivity")
     */
    private $samplingDocuments;

    public function __construct()
    {
        $this->samplingDocuments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->description ? $this->description : 'New Sampling Activity';
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|SamplingDocumentation[]
     */
    public function getSamplingDocuments(): Collection
    {
        return $this->samplingDocuments;
    }

    public function addSamplingDocument(SamplingDocumentation $samplingDocument): self
    {
        if (!$this->samplingDocuments->contains($samplingDocument)) {
            $this->samplingDocuments[] = $samplingDocument;
            $samplingDocument->setSamplingActivity($this);
        }

        return $this;
    }

    public function removeSamplingDocument(SamplingDocumentation $samplingDocument): self
    {
        if ($this->samplingDocuments->contains($samplingDocument)) {
            $this->samplingDocuments->removeElement($samplingDocument);
            // set the owning side to null (unless already changed)
            if ($samplingDocument->getSamplingActivity() === $this) {
                $samplingDocument->setSamplingActivity(null);
            }
        }

        return $this;
    }
}
