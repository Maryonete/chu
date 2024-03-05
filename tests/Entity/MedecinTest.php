<?php

namespace App\Tests\Entity;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class MedecinTest.
 *
 * @covers \App\Entity\Medecin
 */
final class MedecinTest extends TestCase
{
    private ?Medecin $medecin = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->medecin = new Medecin();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->medecin);
    }

    public function testToArray(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Medecin::class))
            ->getProperty('id');
        $property->setValue($this->medecin, $expected);

        $user = new User();
        $user->setFirstname('John')->setLastname('Do');

        $this->medecin->setUser($user);
        $tabTest =  [
            "id" => 42,
            "name" => "Do  John",
        ];
        self::assertSame($tabTest, $this->medecin->toArray());
    }

    public function test__toString(): void
    {
        $user = new User();
        $user->setFirstname('John')->setLastname('Do');

        $this->medecin->setUser($user);

        $expected =  "Do  John";
        self::assertSame($expected, $this->medecin->__toString());
    }
    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Medecin::class))
            ->getProperty('id');
        $property->setValue($this->medecin, $expected);
        self::assertSame($expected, $this->medecin->getId());
    }

    public function testGetSpeciality(): void
    {
        $expected = $this->createMock(Collection::class);
        $property = (new ReflectionClass(Medecin::class))
            ->getProperty('speciality');
        $property->setValue($this->medecin, $expected);
        self::assertSame($expected, $this->medecin->getSpeciality());
    }

    public function testAddSpeciality(): void
    {
        $expected = 1;
        $spe = new Speciality();
        $this->medecin->addSpeciality($spe);
        self::assertSame($expected, count($this->medecin->getSpeciality()));
    }
    public function testRemoveSpeciality(): void
    {
        $expected = 0;
        $spe = new Speciality();
        $this->medecin->addSpeciality($spe);
        $this->medecin->removeSpeciality($spe);
        self::assertSame($expected, count($this->medecin->getSpeciality()));
    }

    public function testGetAndSetUser(): void
    {
        $user = $this->createMock(User::class);
        $this->medecin->setUser($user);
        self::assertSame($user, $this->medecin->getUser());
    }

    public function testGetStays(): void
    {
        $expected = $this->createMock(Collection::class);
        $property = (new ReflectionClass(Medecin::class))
            ->getProperty('stays');
        $property->setValue($this->medecin, $expected);
        self::assertSame($expected, $this->medecin->getStays());
    }

    public function testAddStay(): void
    {
        $expected = 1;
        $stay = $this->createMock(Stay::class);
        $this->medecin->addStay($stay);
        self::assertSame($expected, count($this->medecin->getStays()));
    }

    public function testRemoveStay(): void
    {
        $expected = 0;
        $stay = $this->createMock(Stay::class);
        $this->medecin->addStay($stay);
        $this->medecin->removeStay($stay);
        self::assertNull($stay->getMedecin());

        self::assertSame($expected, count($this->medecin->getStays()));
    }



    public function testGetCalendars(): void
    {
        $expected = $this->createMock(Collection::class);
        $property = (new ReflectionClass(Medecin::class))
            ->getProperty('calendars');
        $property->setValue($this->medecin, $expected);
        self::assertSame($expected, $this->medecin->getCalendars());
    }

    public function testAddCalendar(): void
    {
        $expected = 1;
        $calendar = $this->createMock(Calendar::class);
        $this->medecin->addCalendar($calendar);
        self::assertSame($expected, count($this->medecin->getCalendars()));
    }

    public function testRemoveCalendar(): void
    {
        $expected = 0;
        $calendar = $this->createMock(Calendar::class);
        $this->medecin->addCalendar($calendar);
        $this->medecin->removeCalendar($calendar);
        self::assertSame($expected, count($this->medecin->getCalendars()));
    }
}
