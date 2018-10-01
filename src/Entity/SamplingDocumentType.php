<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SamplingDocumentTypeRepository")
 */
class SamplingDocumentType
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
    private $short_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $long_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SamplingDocumentation", mappedBy="documentType")
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

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getLongName(): ?string
    {
        return $this->long_name;
    }

    public function setLongName(string $long_name): self
    {
        $this->long_name = $long_name;

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
            $samplingDocument->setDocumentType($this);
        }

        return $this;
    }

    public function removeSamplingDocument(SamplingDocumentation $samplingDocument): self
    {
        if ($this->samplingDocuments->contains($samplingDocument)) {
            $this->samplingDocuments->removeElement($samplingDocument);
            // set the owning side to null (unless already changed)
            if ($samplingDocument->getDocumentType() === $this) {
                $samplingDocument->setDocumentType(null);
            }
        }

        return $this;
    }
}
