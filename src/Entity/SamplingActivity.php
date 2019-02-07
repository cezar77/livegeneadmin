<?php

namespace App\Entity;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

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
     * @JMS\MaxDepth(1)
     */
    private $project;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisation", inversedBy="samplingActivities")
     */
    private $samplingPartners;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Species", inversedBy="samplingActivities")
     */
    private $species;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Country", inversedBy="samplingActivities")
     */
    private $countries;

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
     * @JMS\MaxDepth(3)
     */
    private $samplingDocuments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\UserBundle\Entity\User", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Exclude()
     */
    private $owner;

    public function __construct()
    {
        $this->samplingDocuments = new ArrayCollection();
        $this->samplingPartners = new ArrayCollection();
        $this->species = new ArrayCollection();
        $this->countries = new ArrayCollection();
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

    /**
     * @return Collection|Organisation[]
     */
    public function getSamplingPartners(): Collection
    {
        return $this->samplingPartners;
    }

    public function addSamplingPartner(Organisation $samplingPartner): self
    {
        if (!$this->samplingPartners->contains($samplingPartner)) {
            $this->samplingPartners[] = $samplingPartner;
        }

        return $this;
    }

    public function removeSamplingPartner(Organisation $samplingPartner): self
    {
        if ($this->samplingPartners->contains($samplingPartner)) {
            $this->samplingPartners->removeElement($samplingPartner);
        }

        return $this;
    }

    /**
     * @return Collection|Species[]
     */
    public function getSpecies(): Collection
    {
        return $this->species;
    }

    public function addSpecies(Species $species): self
    {
        if (!$this->species->contains($species)) {
            $this->species[] = $species;
        }

        return $this;
    }

    public function removeSpecies(Species $species): self
    {
        if ($this->species->contains($species)) {
            $this->species->removeElement($species);
        }

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->contains($country)) {
            $this->countries->removeElement($country);
        }

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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
