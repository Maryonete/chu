<?php

namespace App\Repository;

use App\Entity\Medication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Medication>
 *
 * @method Medication|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medication|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medication[]    findAll()
 * @method Medication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medication::class);
    }
}
