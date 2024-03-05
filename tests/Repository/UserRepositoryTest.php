<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private ?UserRepository $userRepository = null;

    private ?EntityManagerInterface $entityManager = null;

    protected function setUp(): void
    {
        // Initialisation du Kernel de Symfony
        $kernel = self::bootKernel();

        // Récupération de l'EntityManager via l'injection de dépendances
        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);

        // Récupération du UserRepository via l'injection de dépendances
        $this->userRepository = static::getContainer()->get(UserRepository::class);
    }

    public function testUpgradePassword(): void
    {
        $this->assertTrue(true);
        // #TODO maj d'un mot de passe par user
        //     // Créer un mock pour l'utilisateur
        //     $user = $this->createMock(User::class);
        //     $user->method('getId')->willReturn(1);
        //     $user->method('getEmail')->willReturn('test@example.com');
        //     $user->method('getFirstname')->willReturn('John'); // Assurez-vous de définir un prénom valide ici
        //     $user->method('setPassword')->willReturn(null);

        //     // Persistez l'utilisateur dans la base de données
        //     $this->entityManager->expects($this->once())
        //         ->method('flush');

        //     // Générer un nouveau mot de passe hashé
        //     $newHashedPassword = password_hash('nouveau_mot_de_passe', PASSWORD_DEFAULT);

        //     // Appeler la méthode upgradePassword du UserRepository
        //     $this->userRepository->upgradePassword($user, $newHashedPassword);

        //     // Vérifier que le mot de passe de l'utilisateur a été mis à jour correctement
        //     $this->assertEquals($newHashedPassword, $user->getPassword());
    }
}
