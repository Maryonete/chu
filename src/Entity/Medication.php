<?php

namespace App\Entity;

use App\Repository\MedicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicationRepository::class)]
class Medication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dosage = null;

    #[ORM\ManyToMany(targetEntity: Drugs::class, inversedBy: 'medications')]
    private Collection $drug;

    #[ORM\ManyToMany(targetEntity: Prescription::class, inversedBy: 'medications')]
    private Collection $prescription;

    public function __construct()
    {
        $this->drug = new ArrayCollection();
        $this->prescription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDosage(): ?string
    {
        return $this->dosage;
    }

    public function setDosage(string $dosage): static
    {
        $this->dosage = $dosage;

        return $this;
    }

    /**
     * @return Collection<int, Drugs>
     */
    public function getDrug(): Collection
    {
        return $this->drug;
    }

    public function addDrug(Drugs $drug): static
    {
        if (!$this->drug->contains($drug)) {
            $this->drug->add($drug);
        }

        return $this;
    }

    public function removeDrug(Drugs $drug): static
    {
        $this->drug->removeElement($drug);

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescription(): Collection
    {
        return $this->prescription;
    }

    public function addPrescription(Prescription $prescription): static
    {
        if (!$this->prescription->contains($prescription)) {
            $this->prescription->add($prescription);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): static
    {
        $this->prescription->removeElement($prescription);

        return $this;
    }
}
