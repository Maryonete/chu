<?php

namespace App\Repository;

use App\Entity\Opinions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Opinions>
 *
 * @method Opinions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opinions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opinions[]    findAll()
 * @method Opinions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpinionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opinions::class);
    }
}
