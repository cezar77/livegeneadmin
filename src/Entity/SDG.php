<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SDGRepository")
 */
class SDG
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     */
    private $headline;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     * @Assert\NotBlank()
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=7, unique=true)
     * @Assert\NotBlank()
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Url()
     * @Assert\NotBlank()
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Url()
     * @Assert\NotBlank()
     */
    private $logoUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SDGRole", mappedBy="sdg")
     */
    private $SDGRoles;

    public function __construct()
    {
        $this->SDGRoles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id ? sprintf('%s - %s', $this->id, $this->headline) : '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeadline(): ?string
    {
        return $this->headline;
    }

    public function setHeadline(string $headline): self
    {
        $this->headline = strtoupper($headline);

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

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
            $sDGRole->setSdg($this);
        }

        return $this;
    }

    public function removeSDGRole(SDGRole $sDGRole): self
    {
        if ($this->SDGRoles->contains($sDGRole)) {
            $this->SDGRoles->removeElement($sDGRole);
            // set the owning side to null (unless already changed)
            if ($sDGRole->getSdg() === $this) {
                $sDGRole->setSdg(null);
            }
        }

        return $this;
    }
}
