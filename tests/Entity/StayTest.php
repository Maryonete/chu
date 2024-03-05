<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;


use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use DateTime;
use phpDocumentor\Reflection\Types\Boolean;
use ReflectionClass;
use TypeError;

/**
 * Class StayTest.
 *
 * @covers \App\Entity\Stay
 */
final class StayTest extends TestCase
{
    private Stay $stay;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->stay = new Stay();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->stay);
    }

    public function testToArray(): void
    {
        $user = new User();
        $user->setFirstname('John')->setLastname('Do');

        $patient = new Patient();
        $patient->setUser($user);
        $this->stay->setpatient($patient);

        $color = $this->stay->isValidate() ?  '#1b9476' : '#d9282f';
        $this->stay->setStartDate(new DateTime());
        $this->stay->setEndDate(new DateTime());

        $tabTest = [
            "id"    => $this->stay->getId(),
            "start" => $this->stay->getStartDate()->format('Y-m-d'),
            "end"   => $this->stay->getEndDate()->format('Y-m-d'),
            "etat"  => $this->stay->getEtat(),
            "description" => $this->stay->getDescription(),
            "backgroundColor" => $color,
            "title" => "John Do",
        ];
        self::assertSame($tabTest, $this->stay->toArray());
    }
    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Stay::class))
            ->getProperty('id');
        $property->setValue($this->stay, $expected);
        self::assertSame($expected, $this->stay->getId());
    }

    public function testGetAndSetReason(): void
    {
        $reason = 'disease';
        $this->stay->setReason($reason);
        dump();
        self::assertSame($reason, $this->stay->getReason());
    }

    public function testGetAndSetDescription(): void
    {
        $desc = 'a little description';
        $this->stay->setDescription($desc);
        self::assertSame($desc, $this->stay->getDescription());
    }

    public function testGetAndSetStartDate(): void
    {
        $date = new DateTime();
        $this->stay->setStartDate($date);
        self::assertSame($date, $this->stay->getStartDate());
    }
    /**
     * @dataProvider wrongDateProvider
     */
    public function testSetWrongStartDate($badDate): void
    {
        $this->expectException(TypeError::class);
        $this->stay->setStartDate($badDate);
    }

    public function testGetAndSetEndDate(): void
    {
        $date = new DateTime();
        $this->stay->setEndDate($date);
        self::assertSame($date, $this->stay->getEndDate());
    }
    /**
     * @dataProvider wrongDateProvider
     */
    public function testSetWrongEndDate($badDate): void
    {
        $this->expectException(TypeError::class);
        $this->stay->setEndDate($badDate);
    }
    public function wrongDateProvider()
    {
        return [
            ['2024-01-01'], ['0000-01-22'], ['11'], [1]
        ];
    }
    public function testGetEtat(): void
    {
        $date  = new DateTime('2013-01-29');
        $this->stay->setStartDate($date);
        self::assertSame('passe', $this->stay->getEtat());

        $date  = new DateTime('2030-01-29');
        $this->stay->setEndDate($date);
        self::assertSame('encours', $this->stay->getEtat());


        $date  = new DateTime('2029-01-29');
        $this->stay->setStartDate($date);
        self::assertSame('avenir', $this->stay->getEtat());
    }
    public function testSetWrongEtat(): void
    {
        $etat = 'etat foutu';
        $this->stay->setEtat($etat);
        self::assertNotSame($etat, $this->stay->getEtat());
    }

    public function testGetAndSetSpeciality(): void
    {
        $spe = $this->createMock(Speciality::class);
        $this->stay->setSpeciality($spe);
        self::assertSame($spe, $this->stay->getSpeciality());
    }

    public function testSetWrongSpeciality(): void
    {
        $this->expectException(TypeError::class);
        $wrongClass = $this->createMock(User::class);
        $this->stay->setSpeciality($wrongClass);
    }

    public function testIsAndSetValidate(): void
    {
        $bool = 1;
        $this->stay->setValidate($bool);
        self::assertIsBool($this->stay->isValidate());
        self::assertTrue($this->stay->isValidate());
    }
    public function testGetAndSetpatient(): void
    {
        $patient = $this->createMock(Patient::class);
        $this->stay->setpatient($patient);
        self::assertSame($patient, $this->stay->getpatient());
    }

    public function testGetAndSetMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $this->stay->setMedecin($medecin);
        self::assertSame($medecin, $this->stay->getMedecin());
    }
}
