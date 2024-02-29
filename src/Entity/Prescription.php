<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToOne(targetEntity: Medecin::class, inversedBy: 'prescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Medecin $medecin = null;

    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'prescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Patient $patient = null;

    #[ORM\ManyToMany(targetEntity: Medication::class, mappedBy: 'prescriptions')]
    private Collection $medications;

    public function __construct()
    {
        $this->medications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection<int, Medication>
     */
    public function getMedications(): Collection
    {
        return $this->medications;
    }

    public function addMedication(Medication $medication): self
    {
        if (!$this->medications->contains($medication)) {
            $this->medications[] = $medication;
            $medication->addPrescription($this);
        }

        return $this;
    }

    public function removeMedication(Medication $medication): self
    {
        if ($this->medications->removeElement($medication)) {
            $medication->removePrescription($this);
        }

        return $this;
    }
}
