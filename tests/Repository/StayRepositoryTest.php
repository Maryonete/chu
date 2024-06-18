<?php

namespace App\Tests\Repository;

use App\Entity\Stay;
use App\Entity\Speciality;
use Doctrine\ORM\EntityManager;
use App\Repository\StayRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StayRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if ($this->entityManager !== null) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }

    // public function testStaysAVenirParMedecin(): void
    // {
    //     /** @var StayRepository $repository */
    //     $repository = $this->entityManager->getRepository(Stay::class);

    //     // Test sans limite
    //     // $stays = $repository->staysAVenirParMedecin(2);
    //     // $this->assertCount(3, $stays);

    //     // Test avec limite
    //     $stays = $repository->staysAVenirParMedecin(2, 1);
    //     $this->assertCount(1, $stays);
    // }
}
