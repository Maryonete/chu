<?php

namespace App\Tests\Entity;

use App\Entity\{Prescription, Medecin, Patient, Medication};
use PHPUnit\Framework\TestCase;

class PrescriptionTest extends TestCase
{
    public function testGetId()
    {
        $prescription = new Prescription();
        $this->assertNull($prescription->getId(), 'Initial id should be null');
    }

    public function testGetSetStartDate()
    {
        $prescription = new Prescription();
        $date = new \DateTime('2024-01-01');
        $prescription->setStartDate($date);
        $this->assertSame($date, $prescription->getStartDate(), 'Start date should be set correctly');
    }

    public function testGetSetEndDate()
    {
        $prescription = new Prescription();
        $date = new \DateTime('2024-12-31');
        $prescription->setEndDate($date);
        $this->assertSame($date, $prescription->getEndDate(), 'End date should be set correctly');
    }

    public function testGetSetMedecin()
    {
        $prescription = new Prescription();
        $medecin = new Medecin();
        $prescription->setMedecin($medecin);
        $this->assertSame($medecin, $prescription->getMedecin(), 'Medecin should be set correctly');
    }

    public function testGetSetPatient()
    {
        $prescription = new Prescription();
        $patient = new Patient();
        $prescription->setPatient($patient);
        $this->assertSame($patient, $prescription->getPatient(), 'Patient should be set correctly');
    }

    public function testGetAddMedications()
    {
        $prescription = new Prescription();
        $medication = new Medication();
        $prescription->addMedication($medication);
        $this->assertCount(1, $prescription->getMedications(), 'There should be one medication');
        $this->assertTrue(
            $prescription->getMedications()->contains($medication),
            'Medication should be added correctly'
        );
        $this->assertSame(
            $prescription,
            $medication->getPrescription(),
            'Medication should reference the correct prescription'
        );
    }
}
