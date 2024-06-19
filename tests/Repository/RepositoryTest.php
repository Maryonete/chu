<?php

use App\Entity\{
    Calendar,
    Drugs,
    Medecin,
    Medication,
    Patient,
    Prescription,
    Opinions,
    Speciality,
    Stay,
    User
};
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RepositoryTest extends KernelTestCase
{
    protected ?EntityManager $entityManager;

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

    public function testFind(): void
    {
        // Récupérer un élément pour chaque classe d'entité définie
        foreach ($this->getEntityClasses() as $entityClass) {
            $entity = $this->entityManager
                ->getRepository($entityClass)
                ->find(1);

            $this->assertInstanceOf($entityClass, $entity);
            $this->assertEquals(1, $entity->getId());
        }
    }

    public function testFindAll(): void
    {
        // Récupérer tous les éléments pour chaque classe d'entité définie
        foreach ($this->getEntityClasses() as $entityClass) {
            $entities = $this->entityManager
                ->getRepository($entityClass)
                ->findAll();

            $this->assertNotEmpty($entities);
            $this->assertGreaterThanOrEqual(1, count($entities));
        }
    }

    private function getEntityClasses(): array
    {
        return [
            Calendar::class,
            Drugs::class,
            Medecin::class,
            Medication::class,
            Opinions::class,
            Patient::class,
            Prescription::class,
            Speciality::class,
            Stay::class,
            User::class,
        ];
    }
}
