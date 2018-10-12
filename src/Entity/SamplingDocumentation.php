<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

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
     * @JMS\Exclude()
     */
    private $samplingActivity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SamplingDocumentType", inversedBy="samplingDocuments")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Expose()
     * @JMS\MaxDepth(2)
     */
    private $samplingDocumentType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\MaxDepth(4)
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
        return $this->samplingDocumentType;
    }

    public function setSamplingDocumentType(?SamplingDocumentType $samplingDocumentType): self
    {
        $this->samplingDocumentType = $samplingDocumentType;

        return $this;
    }

    public function getDocument(): ?Media
    {
        return $this->document;
    }

    public function setDocument(?Media $document): self
    {
        $this->document = $document;

        return $this;
    }
}
