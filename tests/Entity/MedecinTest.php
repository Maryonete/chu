<?php

namespace App\Tests\Entity;

use App\Entity\Stay;
use App\Entity\User;
use ReflectionClass;
use App\Entity\Medecin;
use App\Entity\Calendar;
use App\Entity\Speciality;
use PHPUnit\Metadata\Covers;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

#[Covers(Medecin::class)]
final class MedecinTest extends TestCase
{
    private ?Medecin $medecin = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->medecin = new Medecin();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->medecin);
    }

    public function testToArray(): void
    {
        $expectedId = 42;
        $this->setPrivateProperty($this->medecin, 'id', $expectedId);

        $user = new User();
        $user->setFirstname('John')->setLastname('Do');
        $this->medecin->setUser($user);

        $expectedArray = [
            "id" => $expectedId,
            "name" => "Do John",
        ];

        self::assertSame($expectedArray, $this->medecin->toArray());
    }

    public function testToString(): void
    {
        $user = new User();
        $user->setFirstname('John')->setLastname('Do');
        $this->medecin->setUser($user);

        $expectedString = "Do John";
        self::assertSame($expectedString, (string) $this->medecin);
    }

    public function testGetId(): void
    {
        $expectedId = 42;
        $this->setPrivateProperty($this->medecin, 'id', $expectedId);

        self::assertSame($expectedId, $this->medecin->getId());
    }

    public function testGetSpeciality(): void
    {
        $specialityCollection = new ArrayCollection([$this->createMock(Speciality::class)]);
        $this->setPrivateProperty($this->medecin, 'speciality', $specialityCollection);

        self::assertSame($specialityCollection, $this->medecin->getSpeciality());
    }

    public function testAddSpeciality(): void
    {
        $speciality = $this->createMock(Speciality::class);
        $this->medecin->addSpeciality($speciality);

        self::assertCount(1, $this->medecin->getSpeciality());
    }

    public function testRemoveSpeciality(): void
    {
        $speciality = $this->createMock(Speciality::class);
        $this->medecin->addSpeciality($speciality);
        $this->medecin->removeSpeciality($speciality);

        self::assertCount(0, $this->medecin->getSpeciality());
    }

    public function testGetAndSetUser(): void
    {
        $user = $this->createMock(User::class);
        $this->medecin->setUser($user);

        self::assertSame($user, $this->medecin->getUser());
    }

    public function testGetStays(): void
    {
        $staysCollection = new ArrayCollection([$this->createMock(Stay::class)]);
        $this->setPrivateProperty($this->medecin, 'stays', $staysCollection);

        self::assertSame($staysCollection, $this->medecin->getStays());
    }

    public function testAddStay(): void
    {
        $stay = $this->createMock(Stay::class);
        $this->medecin->addStay($stay);

        self::assertCount(1, $this->medecin->getStays());
    }

    public function testRemoveStay(): void
    {
        $stay = $this->createMock(Stay::class);
        $this->medecin->addStay($stay);
        $this->medecin->removeStay($stay);

        self::assertCount(0, $this->medecin->getStays());
    }

    public function testGetCalendars(): void
    {
        $calendarsCollection = new ArrayCollection([$this->createMock(Calendar::class)]);
        $this->setPrivateProperty($this->medecin, 'calendars', $calendarsCollection);

        self::assertSame($calendarsCollection, $this->medecin->getCalendars());
    }

    public function testAddCalendar(): void
    {
        $calendar = $this->createMock(Calendar::class);
        $this->medecin->addCalendar($calendar);

        self::assertCount(1, $this->medecin->getCalendars());
    }

    public function testRemoveCalendar(): void
    {
        $calendar = $this->createMock(Calendar::class);
        $this->medecin->addCalendar($calendar);
        $this->medecin->removeCalendar($calendar);

        self::assertCount(0, $this->medecin->getCalendars());
    }

    private function setPrivateProperty(object $object, string $propertyName, $value): void
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
