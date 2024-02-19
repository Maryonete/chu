<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
#[ApiResource]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Speciality::class, inversedBy: 'medecins')]
    private Collection $speciality;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Stay::class)]
    private Collection $stays;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Calendar::class, orphanRemoval: true)]
    private Collection $calendars;

    public function __construct()
    {
        $this->speciality = new ArrayCollection();
        $this->stays = new ArrayCollection();
        $this->calendars = new ArrayCollection();
    }
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getUser()->getLastName() . "  " . $this->getUser()->getFirstName(),
        ];
    }
    public function __toString()
    {
        return $this->getUser()->getLastName() . "  " . $this->getUser()->getFirstName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return Collection<int, Speciality>
     */
    public function getSpeciality(): Collection
    {
        return $this->speciality;
    }

    public function addSpeciality(Speciality $speciality): static
    {
        if (!$this->speciality->contains($speciality)) {
            $this->speciality->add($speciality);
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): static
    {
        $this->speciality->removeElement($speciality);

        return $this;
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
            $stay->setMedecin($this);
        }

        return $this;
    }

    public function removeStay(Stay $stay): static
    {
        if ($this->stays->removeElement($stay) && $stay->getMedecin() === $this) {
            // set the owning side to null (unless already changed)
            $stay->setMedecin(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): static
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars->add($calendar);
            $calendar->setMedecin($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): static
    {
        if ($this->calendars->removeElement($calendar) && $calendar->getMedecin() === $this) {
            // set the owning side to null (unless already changed)
            $calendar->setMedecin(null);
        }

        return $this;
    }
}
