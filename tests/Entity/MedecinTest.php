<?php

namespace App\Tests\Entity;

use App\Entity\Stay;
use App\Entity\User;
use ReflectionClass;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Calendar;
use App\Entity\Opinions;
use App\Entity\Speciality;
use App\Entity\Prescription;
use PHPUnit\Metadata\Covers;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[Covers(Medecin::class)]
final class MedecinTest extends TestCase
{
    private ?Medecin $medecin = null;
    private Patient $patient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->medecin = new Medecin();
        $this->patient = new Patient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->medecin);
        unset($this->patient);
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

    private function setPrivateProperty(object $object, string $propertyName, $value): void
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
    // PRESCRIPTIONS
    public function testPrescriptions()
    {
        $medecin = new Medecin();

        // Test getPrescriptions
        $prescriptions = $medecin->getPrescriptions();
        $this->assertInstanceOf(Collection::class, $prescriptions);

        // Test addPrescription
        $prescription = new Prescription();
        $medecin->addPrescription($prescription);

        // Assert prescription is added to the collection
        $this->assertTrue($medecin->getPrescriptions()->contains($prescription));

        // Optional: Verify setMedecin is called on Prescription (implementation specific)

        // Test removePrescription
        $medecin->removePrescription($prescription);

        // Assert prescription is removed from the collection
        $this->assertFalse($medecin->getPrescriptions()->contains($prescription));
    }
    // OPINIONS
    public function testOpinions()
    {
        $medecin = new Medecin();

        // Test getOpinions
        $opinions = $medecin->getOpinions();
        $this->assertInstanceOf(Collection::class, $opinions);

        // Test addOpinion
        $opinion = new Opinions();
        $medecin->addOpinion($opinion);

        // Assert opinion is added to the collection
        $this->assertTrue($medecin->getOpinions()->contains($opinion));

        // Optional: Verify setMedecin is called on Opinions (implementation specific)

        // Test removeOpinion
        $medecin->removeOpinion($opinion);

        // Assert opinion is removed from the collection
        $this->assertFalse($medecin->getOpinions()->contains($opinion));
    }
}
