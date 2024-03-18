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
#[ORM\Table(name: 'patient')]
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

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Stay::class, orphanRemoval: true)]
    private Collection $stays;

    #[ORM\OneToMany(targetEntity: Prescription::class, mappedBy: 'patient')]
    private Collection $prescriptions;

    #[ORM\OneToMany(targetEntity: Opinions::class, mappedBy: 'patient')]
    private Collection $opinions;

    public function __construct()
    {
        $this->stays = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->opinions = new ArrayCollection();
    }

    // public function __toString()
    // {
    //     return $this->getUser()->getLastname() . ' ' . $this->getUser()->getFirstname();
    // }
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
    /**
     * @return Collection<int, Stay>
     */
    public function getStays(): Collection
    {
        return $this->stays;
    }

    public function addStay(Stay $stay): static
    {
        if (!$this->stays->contains($stay)) {
            $this->stays->add($stay);
            $stay->setPatient($this);
        }

        return $this;
    }

    public function removeStay(Stay $stay): static
    {
        if ($this->stays->removeElement($stay)) {
            // set the owning side to null (unless already changed)
            if ($stay->getPatient() === $this) {
                $stay->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): static
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setPatient($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): static
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getPatient() === $this) {
                $prescription->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Opinions>
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinions $opinion): static
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions->add($opinion);
            $opinion->setPatient($this);
        }

        return $this;
    }

    public function removeOpinion(Opinions $opinion): static
    {
        if ($this->opinions->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getPatient() === $this) {
                $opinion->setPatient(null);
            }
        }

        return $this;
    }
    /**
     * Get all information of the patient.
     * 
     * @return array
     */
    public function getAllInformation(): array
    {
        $staysInfo = [];
        foreach ($this->stays as $stay) {
            $stayInfo = [
                'id' => $stay->getId(),
                // Ajoutez d'autres informations spécifiques au séjour ici
            ];
            $staysInfo[] = $stayInfo;
        }

        $prescriptionsInfo = [];
        foreach ($this->prescriptions as $prescription) {
            $prescriptionInfo = [
                'id' => $prescription->getId(),
                // Ajoutez d'autres informations spécifiques à la prescription ici
            ];
            $prescriptionsInfo[] = $prescriptionInfo;
        }

        $opinionsInfo = [];
        foreach ($this->opinions as $opinion) {
            $opinionInfo = [
                'id' => $opinion->getId(),
                // Ajoutez d'autres informations spécifiques à l'opinion ici
            ];
            $opinionsInfo[] = $opinionInfo;
        }

        return [
            'id' => $this->id,
            'adlibelle' => $this->adlibelle,
            'adcp' => $this->adcp,
            'adcity' => $this->adcity,
            'adcountry' => $this->adcountry,
            'stays' => $staysInfo,
            'prescriptions' => $prescriptionsInfo,
            'opinions' => $opinionsInfo,
        ];
    }
}
