<?php

namespace App\Tests\Entity;

use App\Entity\{Medication, Drugs, Prescription};
use PHPUnit\Framework\TestCase;

class MedicationTest extends TestCase
{
    public function testGetId()
    {
        $medication = new Medication();
        $this->assertNull($medication->getId(), 'Initial id should be null');
    }

    public function testGetSetDosage()
    {
        $medication = new Medication();
        $dosage = '500mg';
        $medication->setDosage($dosage);
        $this->assertSame($dosage, $medication->getDosage(), 'Dosage should be set correctly');
    }

    public function testGetSetDrug()
    {
        $medication = new Medication();
        $drug = new Drugs();
        $medication->setDrug($drug);
        $this->assertSame($drug, $medication->getDrug(), 'Drug should be set correctly');
    }

    public function testGetSetPrescription()
    {
        $medication = new Medication();
        $prescription = new Prescription();
        $medication->setPrescription($prescription);
        $this->assertSame(
            $prescription,
            $medication->getPrescription(),
            'Prescription should be set correctly'
        );
    }
}
