<?php

namespace App\Tests\Entity;

use App\Entity\Medecin;
use App\Entity\Speciality;
use Doctrine\Common\Collections\Collection;
use ReflectionClass;
use PHPUnit\Framework\TestCase;

/**
 * Class SpecialityTest.
 *
 * @covers \App\Entity\Speciality
 */
final class SpecialityTest extends TestCase
{
    private Speciality $speciality;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->speciality = new Speciality();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->speciality);
    }

    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Speciality::class))
            ->getProperty('id');
        $property->setValue($this->speciality, $expected);
        self::assertSame($expected, $this->speciality->getId());
    }
    public function test__toString(): void
    {
        $expected =  "Biologie";
        $this->speciality->setName($expected);
        self::assertSame($expected, $this->speciality->__toString());
    }
    public function testGetAndSetName(): void
    {
        $name = 'Biologie';
        $this->speciality->setName($name);
        self::assertSame($name, $this->speciality->getName());
    }

    public function testGetAndSetDescription(): void
    {
        $desc = 'Une petit description';
        $this->speciality->setDescription($desc);
        self::assertSame($desc, $this->speciality->getDescription());
    }

    public function testGetMedecins(): void
    {
        $expected = $this->createMock(Collection::class);
        $property = (new ReflectionClass(Speciality::class))
            ->getProperty('medecins');
        $property->setValue($this->speciality, $expected);
        self::assertSame($expected, $this->speciality->getMedecins());
    }

    public function testAddMedecin(): void
    {
        $expected = 1;
        $medecin = $this->createMock(Medecin::class);
        $this->speciality->addMedecin($medecin);
        self::assertSame($expected, count($this->speciality->getMedecins()));
    }

    public function testRemoveMedecin(): void
    {
        $expected = 0;
        $medecin = $this->createMock(Medecin::class);
        $this->speciality->addMedecin($medecin);
        $this->speciality->removeMedecin($medecin);
        self::assertSame($expected, count($this->speciality->getMedecins()));
    }
}
