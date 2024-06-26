<?php

namespace App\Entity;

use TypeError;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[UniqueEntity(fields: ['email'], message: 'Il y a déjà un compte avec cet email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Length(min: 2, max: 180)]
    #[Assert\Email(
        message: 'Cet email {{ value }} n\'est pas valide',
    )]
    private ?string $email = null;

    /**
     * @var array The list of roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\PasswordStrength([
        'minScore' => PasswordStrength::STRENGTH_WEAK,
        'message' => 'Le mots de passe ne contient pas tous les caractéres requis',
    ])]
    private ?string $password = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(min: 2, max: 60)]
    private ?string $firstname = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(min: 2, max: 60)]
    private ?string $lastname = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Patient $patient = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Medecin $medecin = null;

    public function __toString()
    {
        return $this->getFirstName() . '  ' . $this->getLastName();
    }

    public function toArray(): array
    {
        return [
            "id"    => $this->getId(),
            "name"  => $this->getLastName() . "  " . $this->getFirstName(),
        ];
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new TypeError('Format de l\'Email Incorrect');
        } else {
            $this->email = $email;
        }
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique($roles);
    }
    public function isAdmin(): bool
    {
        return in_array("ROLE_ADMIN", $this->getRoles());
    }
    public function isUser(): bool
    {
        return in_array("ROLE_USER", $this->getRoles());
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here

        // $this->password = null;

    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): static
    {
        // set the owning side of the relation if necessary
        if ($patient->getUser() !== $this) {
            $patient->setUser($this);
        }

        $this->patient = $patient;

        return $this;
    }

    /**
     * Get the value of medecin
     */
    public function getMedecin(): Medecin
    {
        return $this->medecin;
    }

    /**
     * Set the value of medecin
     */
    public function setMedecin(Medecin $medecin): static
    {
        // set the owning side of the relation if necessary
        if ($medecin->getUser() !== $this) {
            $medecin->setUser($this);
        }
        $this->medecin = $medecin;

        return $this;
    }
}
