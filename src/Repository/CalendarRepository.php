<?php

namespace App\Repository;

use App\Entity\Calendar;
use App\Entity\Medecin;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * @extends ServiceEntityRepository<Calendar>
 *
 * @method Calendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendar[]    findAll()
 * @method Calendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarRepository extends ServiceEntityRepository
{
    private DateTime $now;
    private ParameterBagInterface $parameterBagInterface;

    public function __construct(ManagerRegistry $registry, ParameterBagInterface $parameterBagInterface)
    {
        parent::__construct($registry, Calendar::class);
        $this->now = new DateTime();
        $this->parameterBagInterface = $parameterBagInterface;
    }
    /**
     * 
     *
     * @param DatetimeInterface $sdate : start date
     * @param DateTimeInterface $edate : end date
     * @return array
     */
    public function countDays($sdate, $edate): array
    {
        $dates  = [];
        for ($i = $sdate; $i < $edate; $i->modify("+1 day")) {
            $dates[] = $i->format('Y-m-d');
        }
        return $dates;
    }
    /**
     * returns table of doctor's unavailable days
     *
     * @param Medecin $medecin
     * @return array
     */
    public function getDaysBusy(Medecin $medecin): ?array
    {
        $calendarAll =  [];
        $calendarBusy = [];

        $calendars = $medecin->getCalendars();

        foreach ($calendars as $calendar) {
            if ($this->now > $calendar->getEnd()) {
                continue;
            }

            $jourBusy = self::countDays($calendar->getStart(), $calendar->getEnd());
            foreach ($jourBusy as $date) {

                if (array_key_exists($date, $calendarAll)) {
                    $calendarAll[$date]++;
                    if ($calendarAll[$date] > $this->parameterBagInterface->get('medecin_event_limit_day')) {
                        $calendarBusy[] = $date;
                    }
                } else {
                    $calendarAll[$date] = 1;
                }
            }
        }
        return $calendarBusy;
    }
}
