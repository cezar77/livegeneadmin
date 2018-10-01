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
     * @ORM\ManyToOne(targetEntity="App\Entity\Partnership", inversedBy="samplingActivities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partnership;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SamplingDocumentation", mappedBy="samplingActivity")
     */
    private $samplingDocuments;

    public function __construct()
    {
        $this->samplingDocuments = new ArrayCollection();
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

    public function getPartnership(): ?Partnership
    {
        return $this->partnership;
    }

    public function setPartnership(?Partnership $partnership): self
    {
        $this->partnership = $partnership;

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
