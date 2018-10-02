<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SamplingDocumentationRepository")
 */
class SamplingDocumentation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SamplingActivity", inversedBy="samplingDocuments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $samplingActivity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SamplingDocumentType", inversedBy="samplingDocuments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $documentType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please upload a document as PDF file")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $document;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSamplingActivity(): ?SamplingActivity
    {
        return $this->samplingActivity;
    }

    public function setSamplingActivity(?SamplingActivity $samplingActivity): self
    {
        $this->samplingActivity = $samplingActivity;

        return $this;
    }

    public function getSamplingDocumentType(): ?SamplingDocumentType
    {
        return $this->documentType;
    }

    public function setSamplingDocumentType(?SamplingDocumentType $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;

        return $this;
    }
}
