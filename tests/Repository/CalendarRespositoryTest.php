<?php

namespace App\Tests\Repository;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Repository\CalendarRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalendarRespositoryTest extends KernelTestCase
{
    private EntityManager $entityManager;
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    /**
     * @dataProvider datesProvider
     */
    public function testCountDays($dateS, $dateE, $expected): void
    {
        $dates = $this->entityManager
            ->getRepository(Calendar::class)
            ->countDays($dateS, $dateE);

        $this->assertSame($expected, count($dates));
    }
    public function datesProvider()
    {
        return [
            [new DateTime('2021-01-01'), new DateTime('2021-01-05'), 4],
            [new DateTime('2022-10-01'), new DateTime('2022-10-10'), 9],

            [new DateTime('2024-10-01'), new DateTime('2024-10-10'), 9],
            [new DateTime('2024-10-01'), new DateTime('2024-10-10'), 9],
        ];
    }

    public function testGetDaysBusy()
    {
        // Créez un médecin fictif avec des calendriers fictifs
        $medecin = new Medecin();

        // Créez des calendriers fictifs avec des dates de début et de fin
        $calendar1 = new Calendar();
        $calendar1->setStart(new \DateTime('2024-02-01'));
        $calendar1->setEnd(new \DateTime('2024-02-05'));

        $calendar2 = new Calendar();
        $calendar2->setStart(new \DateTime('2024-02-06'));
        $calendar2->setEnd(new \DateTime('2024-02-10'));

        $medecin->addCalendar($calendar1);
        $medecin->addCalendar($calendar2);

        $calendarRepository = $this->createMock(CalendarRepository::class);

        $result = $calendarRepository->getDaysBusy($medecin);

        $this->assertEmpty($result);
    }
    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        // $this->entityManager = null;
    }
}
