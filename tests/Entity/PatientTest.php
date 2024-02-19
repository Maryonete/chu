<?php

namespace App\Tests\Entity;

use App\Entity\Patient;
use App\Entity\Stay;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class PatientTest.
 *
 * @covers \App\Entity\Patient
 */
final class PatientTest extends TestCase
{
    private Patient $patient;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->patient = new Patient();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->patient);
    }


    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Patient::class))
            ->getProperty('id');
        $property->setValue($this->patient, $expected);
        self::assertSame($expected, $this->patient->getId());
    }

    public function testGetAnsSetUser(): void
    {
        $user = $this->createMock(User::class);
        $this->patient->setUser($user);
        self::assertSame($user, $this->patient->getUser());
    }

    public function testGetAndSetAdlibelle(): void
    {
        $adLib = "rue du four";
        $this->patient->setAdlibelle($adLib);
        self::assertSame($adLib, $this->patient->getAdlibelle());
    }

    public function testGetAndSetAdcp(): void
    {
        $adCP = "34007";
        $this->patient->setAdcp($adCP);
        self::assertSame($adCP, $this->patient->getAdcp());
    }

    // public function testSetWrongAdcp(): void
    // {
    //     $expected = 'aaaaaaaaaaaaaaaaaaaaaa';
    //     $this->patient->setAdcp($expected);
    //     self::assertSame($expected, $this->patient->getAdcp());
    // }

    public function testGetAndSetAdcity(): void
    {
        $city = 'Paris';
        $this->patient->setAdcity($city);
        self::assertSame($city, $this->patient->getAdcity());
    }

    public function testGetAndSetAdcountry(): void
    {
        $country = 'France';
        $this->patient->setAdcountry($country);
        self::assertSame($country, $this->patient->getAdcountry());
    }

    public function testGetStays(): void
    {
        $expected = $this->createMock(Collection::class);
        $property = (new ReflectionClass(Patient::class))
            ->getProperty('stays');
        $property->setValue($this->patient, $expected);
        self::assertSame($expected, $this->patient->getStays());
    }

    public function testAddStay(): void
    {
        $expected = 1;
        $stay = new Stay();
        $this->patient->addStay($stay);
        self::assertSame($expected, count($this->patient->getStays()));
    }

    public function testRemoveStay(): void
    {
        $expected = 0;
        $stay = new Stay();
        $this->patient->addStay($stay);
        $this->patient->removeStay($stay);
        self::assertSame($expected, count($this->patient->getStays()));
    }
}
