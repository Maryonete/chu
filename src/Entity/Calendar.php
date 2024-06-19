<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CalendarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
#[ApiResource]
class Calendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Stay $stay = null;

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        $color = $this->getStay() ? "" : "#378006";
        return [
            "id"    => $this->getId(),
            "start" => $this->getStart()->format('Y-m-d H:i:s'),
            "end"   => $this->getEnd()->format('Y-m-d H:i:s'),
            "title" => $this->getTitle(),
            // "url"   => "/admin/calendar/" . $this->getId() . "/edit/",
            "backgroundColor" => $color,
        ];
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): static
    {
        $this->end = $end;

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

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getStay(): ?Stay
    {
        return $this->stay;
    }

    public function setStay(?Stay $stay): static
    {
        $this->stay = $stay;

        return $this;
    }
}
