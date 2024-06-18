<?php

namespace App\Repository;

use App\Entity\Prescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prescription>
 *
 * @method Prescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prescription[]    findAll()
 * @method Prescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prescription::class);
    }
    /**
     * retourne toutes les prescriptions liées à un patient
     *
     * @param integer $idPatient
     * @return array|null
     */
    public function findAllPrescriptionByPatient(int $idPatient): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p', 'm', 'd')
            ->leftJoin('p.medications', 'm')
            ->leftJoin('m.drug', 'd')
            ->andWhere('p.patient = :idPatient')
            ->setParameter('idPatient', $idPatient)
            ->orderBy('p.startDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
