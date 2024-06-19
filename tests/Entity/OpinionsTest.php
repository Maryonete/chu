<?php

namespace App\Tests\Entity;

use App\Entity\{Opinions, Patient, Medecin};
use PHPUnit\Framework\TestCase;

class OpinionsTest extends TestCase
{
    public function testGetId()
    {
        $opinion = new Opinions();
        $this->assertNull($opinion->getId(), 'Initial id should be null');
    }

    public function testGetSetTitle()
    {
        $opinion = new Opinions();
        $title = 'Great Doctor';
        $opinion->setTitle($title);
        $this->assertSame($title, $opinion->getTitle(), 'Title should be set correctly');
    }

    public function testGetSetDate()
    {
        $opinion = new Opinions();
        $date = new \DateTime();
        $opinion->setDate($date);
        $this->assertSame($date, $opinion->getDate(), 'Date should be set correctly');
    }

    public function testGetSetDescription()
    {
        $opinion = new Opinions();
        $description = 'Very good experience with the doctor.';
        $opinion->setDescription($description);
        $this->assertSame($description, $opinion->getDescription(), 'Description should be set correctly');
    }

    public function testGetSetPatient()
    {
        $opinion = new Opinions();
        $patient = new Patient();
        $opinion->setPatient($patient);
        $this->assertSame($patient, $opinion->getPatient(), 'Patient should be set correctly');
    }

    public function testGetSetMedecin()
    {
        $opinion = new Opinions();
        $medecin = new Medecin();
        $opinion->setMedecin($medecin);
        $this->assertSame($medecin, $opinion->getMedecin(), 'Medecin should be set correctly');
    }
}
