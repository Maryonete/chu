<?php

namespace App\Entity;

use App\Repository\MedicationRepository;
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

    #[ORM\ManyToOne(targetEntity: Drugs::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Drugs $drug = null;

    #[ORM\ManyToOne(targetEntity: Prescription::class, inversedBy: 'medications')]
    #[ORM\JoinColumn(nullable: false)]
    private $prescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDosage(): ?string
    {
        return $this->dosage;
    }

    public function setDosage(string $dosage): self
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getDrug(): ?Drugs
    {
        return $this->drug;
    }

    public function setDrug(?Drugs $drug): self
    {
        $this->drug = $drug;

        return $this;
    }

    public function getPrescription(): ?Prescription
    {
        return $this->prescription;
    }

    public function setPrescription(?Prescription $prescription): self
    {
        $this->prescription = $prescription;

        return $this;
    }
}
