<?php

namespace App\Tests\Entity;

use DateTime;
use TypeError;
use App\Entity\{Medecin, Patient, Speciality, Stay, User};
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

#[Covers(Stay::class)]
final class StayTest extends TestCase
{
    private static Stay $stay;

    protected function setUp(): void
    {
        parent::setUp();
        self::$stay = new Stay();
    }

    public function testToArray(): void
    {
        $user = new User();
        $user->setFirstname('John')->setLastname('Do');

        $patient = new Patient();
        $patient->setUser($user);
        self::$stay->setpatient($patient);

        $color = self::$stay->isValidate() ?  '#1b9476' : '#d9282f';
        self::$stay->setStartDate(new DateTime());
        self::$stay->setEndDate(new DateTime());

        $tabTest = [
            "id"    => self::$stay->getId(),
            "start" => self::$stay->getStartDate()->format('Y-m-d'),
            "end"   => self::$stay->getEndDate()->format('Y-m-d'),
            "etat"  => self::$stay->getEtat(),
            "description" => self::$stay->getDescription(),
            "backgroundColor" => $color,
            "title" => "John Do",
        ];
        self::assertSame($tabTest, self::$stay->toArray());
    }

    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Stay::class))
            ->getProperty('id');
        $property->setValue(self::$stay, $expected);
        self::assertSame($expected, self::$stay->getId());
    }

    public function testGetAndSetReason(): void
    {
        $reason = 'disease';
        self::$stay->setReason($reason);
        self::assertSame($reason, self::$stay->getReason());
    }

    public function testGetAndSetDescription(): void
    {
        $desc = 'a little description';
        self::$stay->setDescription($desc);
        self::assertSame($desc, self::$stay->getDescription());
    }

    public function testGetAndSetStartDate(): void
    {
        $date = new DateTime();
        self::$stay->setStartDate($date);
        self::assertSame($date, self::$stay->getStartDate());
    }

    #[DataProvider('wrongDateProvider')]
    public function testSetWrongStartDate($badDate): void
    {
        $this->expectException(TypeError::class);
        self::$stay->setStartDate($badDate);
    }

    public static function wrongDateProvider(): array
    {
        return [
            ['2024-01-01'], ['0000-01-22'], ['11'], [1]
        ];
    }

    #[DataProvider('wrongDateProvider')]
    public static function dataProviderForSetWrongStartDate(): array
    {
        return self::wrongDateProvider();
    }

    public function testGetEtat(): void
    {
        $date  = new DateTime('2013-01-29');
        self::$stay->setStartDate($date);
        self::assertSame('passe', self::$stay->getEtat());

        $date  = new DateTime('2030-01-29');
        self::$stay->setEndDate($date);
        self::assertSame('encours', self::$stay->getEtat());

        $date  = new DateTime('2029-01-29');
        self::$stay->setStartDate($date);
        self::assertSame('avenir', self::$stay->getEtat());
    }

    public function testSetWrongEtat(): void
    {
        $etat = 'etat foutu';
        self::$stay->setEtat($etat);
        self::assertNotSame($etat, self::$stay->getEtat());
    }

    public function testGetAndSetSpeciality(): void
    {
        $spe = $this->createMock(Speciality::class);
        self::$stay->setSpeciality($spe);
        self::assertSame($spe, self::$stay->getSpeciality());
    }

    public function testSetWrongSpeciality(): void
    {
        $this->expectException(TypeError::class);
        $wrongClass = $this->createMock(User::class);
        self::$stay->setSpeciality($wrongClass);
    }

    public function testIsAndSetValidate(): void
    {
        $bool = true;
        self::$stay->setValidate($bool);
        self::assertIsBool(self::$stay->isValidate());
        self::assertTrue(self::$stay->isValidate());
    }

    public function testGetAndSetpatient(): void
    {
        $patient = $this->createMock(Patient::class);
        self::$stay->setpatient($patient);
        self::assertSame($patient, self::$stay->getpatient());
    }

    public function testGetAndSetMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        self::$stay->setMedecin($medecin);
        self::assertSame($medecin, self::$stay->getMedecin());
    }
}
