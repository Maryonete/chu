<?php

namespace App\Entity;

use DateTime;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\StayRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StayRepository::class)]
#[ApiResource]
class Stay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan('today UTC')]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan(propertyPath: 'start_date')]
    private ?\DateTimeInterface $end_date = null;

    private ?string $etat = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Speciality $speciality = null;

    #[ORM\Column]
    private ?bool $validate = null;

    #[ORM\ManyToOne(inversedBy: 'stays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'stays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin = null;

    public function __construct()
    {
        $this->validate = false;
    }

    public function toArray(): array
    {
        $color = $this->isValidate() ?  '#1b9476' : '#d9282f';

        return [
            "id"    => $this->getId(),
            "start" => $this->getStartDate()->format('Y-m-d'),
            "end"   => $this->getEndDate()->format('Y-m-d'),
            "etat"  => $this->getEtat(),
            "description" => $this->getDescription(),
            "backgroundColor" => $color,
            "title" => $this->getpatient()->getUser()->getFirstname() .
                " " . $this->getpatient()->getUser()->getLastname(),
        ];
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }


    /**
     * Get the value of etat
     */
    public function getEtat(): string
    {
        $now = new DateTime("now");
        if ($this->getStartDate() > $now) {
            $this->setEtat('avenir');
        } elseif ($now > $this->getEndDate()) {
            $this->setEtat('passe');
        } else {
            $this->setEtat('encours');
        }
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */
    public function setEtat(string $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): static
    {
        $this->speciality = $speciality;

        return $this;
    }



    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): static
    {
        $this->validate = $validate;

        return $this;
    }


    public function getpatient(): ?Patient
    {
        return $this->patient;
    }

    public function setpatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }
}
