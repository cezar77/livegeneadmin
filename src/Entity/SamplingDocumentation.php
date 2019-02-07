<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Application\Sonata\UserBundle\Entity\User;
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
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\MaxDepth(2)
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\UserBundle\Entity\User", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Exclude()
     */
    private $owner;

    public function __toString()
    {
        return $this->id ? $this->getDocument()->getName() : '';
    }

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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @JMS\VirtualProperty()
     */
    public function getDownload(): string
    {
        return sprintf('/media/download/%s', $this->getDocument()->getId());
    }
}
