<?php

namespace App\Repository;

use App\Entity\Drugs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Drugs>
 *
 * @method Drugs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Drugs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Drugs[]    findAll()
 * @method Drugs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrugsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Drugs::class);
    }
}
