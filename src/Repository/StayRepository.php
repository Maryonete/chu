<?php

namespace App\Repository;

use App\Entity\Stay;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stay>
 *
 * @method Stay|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stay|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stay[]    findAll()
 * @method Stay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stay::class);
    }
    /**
     * retourne nombre de séjour d'un patient
     *
     * @param int $id
     * @return integer
     */
    public function countStayByPatient($id): int
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->andWhere('s.patient = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function staysAVenirParMedecin(int $id, ?int $limit = null): ?array
    {
        // SELECT id FROM stay WHERE start_date > CURRENT_DATE() and medecin_id=' . $medecin->getId() . '  LIMIT 1'
        $qb = $this->createQueryBuilder('s')
            ->andWhere('s.medecin = :id')
            ->setParameter('id', $id)
            ->andWhere('s.start_date > CURRENT_DATE()');
        if (null !== $limit) {
            $qb->setMaxResults($limit);
        }
        return $qb->getQuery()->getResult();
    }

    public function findByPatient(int $id, string $etat = null): ?array
    {
        $sejours =  $this->createQueryBuilder('s')
            ->andWhere('s.patient = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        // calcul etat du séjour : ENCOURS, PASSE, AVENIR
        $now   = new DateTime("now");
        $tabResult = [];
        foreach ($sejours as $sejour) {
            $start = $sejour->getStartDate();
            $end = $sejour->getEndDate();
            if ($start > $now) {
                $sejour->setEtat('avenir');
            } elseif ($now > $end) {
                $sejour->setEtat('passe');
            } else {
                $sejour->setEtat('encours');
            }
            if (!$etat ||  $etat == $sejour->getEtat()) {
                $tabResult[] =  $sejour;
            }
        }
        return $tabResult;
    }
}
