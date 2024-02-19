<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ORM\Table(name: 'Patient')]
#[ApiResource]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 2)]
    private ?string $adlibelle = null;

    #[ORM\Column(length: 10)]
    #[Assert\Length(min: 5, max: 8)]
    private ?string $adcp = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $adcity = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $adcountry = null;

    #[ORM\OneToOne(inversedBy: 'patient', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __toString()
    {
        return $this->getUser();
    }
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of adlibelle
     */
    public function getAdlibelle(): string
    {
        return $this->adlibelle;
    }

    /**
     * Set the value of adlibelle
     *
     * @return  self
     */
    public function setAdlibelle(string $adlibelle)
    {
        $this->adlibelle = $adlibelle;

        return $this;
    }

    /**
     * Get the value of adcp
     */
    public function getAdcp(): string
    {
        return $this->adcp;
    }

    /**
     * Set the value of adcp
     *
     * @return  self
     */
    public function setAdcp(string $adcp)
    {
        $this->adcp = $adcp;

        return $this;
    }

    /**
     * Get the value of adcity
     */
    public function getAdcity(): string
    {
        return $this->adcity;
    }

    /**
     * Set the value of adcity
     *
     * @return  self
     */
    public function setAdcity(string $adcity)
    {
        $this->adcity = $adcity;

        return $this;
    }

    /**
     * Get the value of adcountry
     */
    public function getAdcountry(): string
    {
        return $this->adcountry;
    }

    /**
     * Set the value of adcountry
     *
     * @return  self
     */
    public function setAdcountry(string $adcountry)
    {
        $this->adcountry = $adcountry;

        return $this;
    }
}
