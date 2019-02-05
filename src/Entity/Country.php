<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Intl\Intl;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2, unique=true)
     * @Assert\Country()
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Organisation", mappedBy="country")
     */
    private $organisations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CountryRole", mappedBy="country")
     */
    private $countryRoles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SamplingActivity", mappedBy="countries")
     */
    private $samplingActivities;

    public function __construct()
    {
        $this->organisations = new ArrayCollection();
        $this->countryRoles = new ArrayCollection();
        $this->samplingActivities = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->country ? $this->getCountryName() : '';
    }

    public function getCountryName()
    {
        return Intl::getRegionBundle()->getCountryName($this->getCountry());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Organisation[]
     */
    public function getOrganisations(): Collection
    {
        return $this->organisations;
    }

    public function addOrganisation(Organisation $organisation): self
    {
        if (!$this->organisations->contains($organisation)) {
            $this->organisations[] = $organisation;
            $organisation->setCountry($this);
        }

        return $this;
    }

    public function removeOrganisation(Organisation $organisation): self
    {
        if ($this->organisations->contains($organisation)) {
            $this->organisations->removeElement($organisation);
            // set the owning side to null (unless already changed)
            if ($organisation->getCountry() === $this) {
                $organisation->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CountryRole[]
     */
    public function getCountryRoles(): Collection
    {
        return $this->countryRoles;
    }

    public function addCountryRole(CountryRole $countryRole): self
    {
        if (!$this->countryRoles->contains($countryRole)) {
            $this->countryRoles[] = $countryRole;
            $countryRole->setCountry($this);
        }

        return $this;
    }

    public function removeCountryRole(CountryRole $countryRole): self
    {
        if ($this->countryRoles->contains($countryRole)) {
            $this->countryRoles->removeElement($countryRole);
            // set the owning side to null (unless already changed)
            if ($countryRole->getCountry() === $this) {
                $countryRole->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SamplingActivity[]
     */
    public function getSamplingActivities(): Collection
    {
        return $this->samplingActivities;
    }

    public function addSamplingActivity(SamplingActivity $samplingActivity): self
    {
        if (!$this->samplingActivities->contains($samplingActivity)) {
            $this->samplingActivities[] = $samplingActivity;
            $samplingActivity->addCountry($this);
        }

        return $this;
    }

    public function removeSamplingActivity(SamplingActivity $samplingActivity): self
    {
        if ($this->samplingActivities->contains($samplingActivity)) {
            $this->samplingActivities->removeElement($samplingActivity);
            $samplingActivity->removeCountry($this);
        }

        return $this;
    }
}
