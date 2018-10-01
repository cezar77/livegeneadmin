<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=50)
     */
    private $headline;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $full_name;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo_url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SDGRole", mappedBy="sdg")
     */
    private $SDGRoles;

    public function __construct()
    {
        $this->SDGRoles = new ArrayCollection();
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
        $this->headline = $headline;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

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
        return $this->logo_url;
    }

    public function setLogoUrl(string $logo_url): self
    {
        $this->logo_url = $logo_url;

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
