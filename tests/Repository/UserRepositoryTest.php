<?php

namespace App\Tests\Repository;

use App\Entity\Medecin;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


class UserRepositoryTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;
    private ?UserRepository $userRepository;

    protected function setUp(): void
    {
        // Initialisation du kernel Symfony pour accéder aux services
        self::bootKernel();

        // Récupération de l'EntityManager à partir du conteneur de services
        $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);

        // Récupération du UserRepository à partir du conteneur de services
        $this->userRepository = self::getContainer()->get(UserRepository::class);
    }

    public function testUpgradePassword(): void
    {
        // Création d'un utilisateur fictif
        $user = new User();
        $user->setEmail('testUpgradePassword@free.fr');
        $user->setFirstname('first');
        $user->setLastname('last');
        $user->setPassword('old_password'); // Mot de passe existant

        // Nouveau mot de passe hashé
        $newHashedPassword = password_hash('new_password', PASSWORD_DEFAULT);

        // Appel de la méthode upgradePassword du UserRepository
        $this->userRepository->upgradePassword($user, $newHashedPassword);

        // Vérification que le mot de passe a bien été mis à jour
        $this->assertEquals($newHashedPassword, $user->getPassword());

        // Vérification que l'utilisateur a été persisté en base de données
        $this->entityManager->flush();
        $this->assertNotNull($user->getId()); // Vérifie que l'utilisateur a un ID (donc qu'il est persisté en base)
    }


    protected function tearDown(): void
    {
        parent::tearDown();

        // Fermeture de l'EntityManager
        if ($this->entityManager !== null) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }
}
