<?php

namespace App\Tests\Repository;

use DateTime;
use App\Entity\User;
use App\Entity\Medecin;
use App\Entity\Calendar;
use Doctrine\ORM\EntityManager;
use App\Repository\CalendarRepository;
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[DataProvider('datesProvider')]
    public function testCountDays($dateS, $dateE, $expected): void
    {
        $dates = $this->entityManager
            ->getRepository(Calendar::class)
            ->countDays($dateS, $dateE);

        $this->assertSame($expected, count($dates));
    }
    public static function datesProvider()
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
    public function testFindPatientsOfTodayByMedecin(): void
    {
        // Créez un médecin fictif
        $user = (new User())->setEmail('testFindPatientsOfTodayByMedecin@studi.fr')->setPassword('testretAa!1');
        $medecin = new Medecin();
        $user->setMedecin($medecin);
        $medecin->getUser()->setFirstname('Dr. Firstname')->setLastname('Lastname');
        $this->entityManager->persist($medecin);
        $this->entityManager->flush();

        // Créez des calendriers fictifs pour aujourd'hui avec le médecin associé
        $calendar1 = new Calendar();
        $calendar1->setMedecin($medecin);
        $calendar1->setStart(new \DateTime('today'));
        $calendar1->setEnd(new \DateTime('today'));
        $calendar1->setTitle('testFindPatientsOfTodayByMedecin1');

        $calendar2 = new Calendar();
        $calendar2->setMedecin($medecin);
        $calendar2->setStart(new \DateTime('today'));
        $calendar2->setEnd(new \DateTime('today'));
        $calendar2->setTitle('testFindPatientsOfTodayByMedecin2');

        $this->entityManager->persist($calendar1);
        $this->entityManager->persist($calendar2);
        $this->entityManager->flush();

        // Exécutez la méthode à tester
        $repository = $this->entityManager->getRepository(Calendar::class);
        $patients = $repository->findPatientsOfTodayByMedecin($medecin->getId());

        // Assertions
        $this->assertNotEmpty($patients);
        $this->assertCount(2, $patients); // Vérifiez le nombre de calendriers récupérés

        foreach ($patients as $calendar) {
            $this->assertInstanceOf(Calendar::class, $calendar);
            $this->assertEquals($medecin->getId(), $calendar->getMedecin()->getId());
        }
    }

    public function testFindAllPatientsOfToday(): void
    {
        // Exécutez la méthode à tester
        $repository = $this->entityManager->getRepository(Calendar::class);
        $patients = $repository->findAllPatientsOfToday();

        // Assertions
        $this->assertNotEmpty($patients);
        $this->assertCount(17, $patients); // Vérifiez le nombre de calendriers récupérés

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }
}
