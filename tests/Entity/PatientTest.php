<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Stay;
use App\Entity\User;
use ReflectionClass;
use App\Entity\Drugs;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Opinions;
use App\Entity\Medication;
use App\Entity\Speciality;
use App\Entity\Prescription;
use PHPUnit\Metadata\Covers;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[Covers(Patient::class)]
final class PatientTest extends TestCase
{
    private Patient $patient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->patient = new Patient();
    }

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
    // PRESCRIPTIONS
    public function testGetPrescriptions(): void
    {
        $prescription1 = new Prescription();
        $prescription2 = new Prescription();

        $this->patient->addPrescription($prescription1);
        $this->patient->addPrescription($prescription2);

        $prescriptions = $this->patient->getPrescriptions();

        $this->assertInstanceOf(ArrayCollection::class, $prescriptions);
        $this->assertCount(2, $prescriptions);
    }

    public function testAddPrescription(): void
    {
        $prescription = new Prescription();
        $this->patient->addPrescription($prescription);

        $this->assertTrue($this->patient->getPrescriptions()->contains($prescription));
        $this->assertSame($this->patient, $prescription->getPatient());
    }

    public function testRemovePrescription(): void
    {
        $prescription = new Prescription();
        $this->patient->addPrescription($prescription);

        $this->patient->removePrescription($prescription);

        $this->assertFalse($this->patient->getPrescriptions()->contains($prescription));
        $this->assertNull($prescription->getPatient());
    }
    // OPINIONS
    public function testGetOpinions(): void
    {
        $opinion1 = new Opinions();
        $opinion2 = new Opinions();

        $this->patient->addOpinion($opinion1);
        $this->patient->addOpinion($opinion2);

        $opinions = $this->patient->getOpinions();

        $this->assertInstanceOf(ArrayCollection::class, $opinions);
        $this->assertCount(2, $opinions);
    }

    public function testAddOpinion(): void
    {
        $opinion = new Opinions();
        $this->patient->addOpinion($opinion);

        $this->assertTrue($this->patient->getOpinions()->contains($opinion));
        $this->assertSame($this->patient, $opinion->getPatient());
    }

    public function testRemoveOpinion(): void
    {
        $opinion = new Opinions();
        $this->patient->addOpinion($opinion);

        $this->patient->removeOpinion($opinion);

        $this->assertFalse($this->patient->getOpinions()->contains($opinion));
        $this->assertNull($opinion->getPatient());
    }

    public function testGetAllInformation()
    {
        $user = new User();
        $patient = new Patient();
        $user->setPatient($patient);
        $patient->getUser()->setFirstname('John')->setLastname('Doe');
        $idPatient = $patient->getId();
        $patient->setAdlibelle('123456789');
        $patient->setAdcp('12345');
        $patient->setAdcity('Some City');
        $patient->setAdcountry('France');

        // // Create mock Stay objects (if Stay logic is complex)
        $stay1 = $this->createMock(Stay::class);
        $stay1->method('isValidate')->willReturn(true);
        $stay1->method('getId')->willReturn(10);
        $stay1->method('getReason')->willReturn('Reason for stay');
        $stay1->method('getDescription')->willReturn('Description of stay');
        $startDate = new DateTime('2023-06-01');
        $stay1->method('getStartDate')->willReturn($startDate);
        $endDate = new DateTime('2023-06-10');
        $stay1->method('getEndDate')->willReturn($endDate);
        $stay1->method('getEtat')->willReturn('Etat');

        // Create a mock Speciality
        $speciality = new Speciality;
        $idSpeciality = $speciality->getId();
        $speciality->setName('Speciality Name');
        $stay1->method('getSpeciality')->willReturn($speciality);

        // MEDECIN
        $user = new User();
        $medecin = new Medecin();
        $user->setMedecin($medecin);
        $medecin->getUser()->setFirstname('Dr. Firstname')->setLastname('Lastname');
        $idMedecin = $patient->getId();

        $stay1->method('getMedecin')->willReturn($medecin);

        $patient->addStay($stay1);

        // Create mock Prescription objects (if Prescription logic is complex)
        $prescription1 = new Prescription;
        $idPrescription1 = $prescription1->getId();
        $prescription1->setStartDate($startDate);
        $prescription1->setEndDate($endDate);
        $prescription1->setMedecin($medecin);

        // Create Medication
        $medication1 = new Medication;
        $idMedication1 = $medication1->getId();
        $medication1->setDosage('10mg');

        // Create Mock Drugs
        $drug1 = $this->createMock(Drugs::class);
        $drug1->method('getName')->willReturn('Drug Name');
        $medication1->setDrug($drug1);
        // Configurer getMedications() pour retourner la collection créée
        $prescription1->addMedication($medication1);
        $patient->addPrescription($prescription1);

        // // Create mock Opinion objects (if Opinion logic is complex)
        $opinion1 = new Opinions;
        $idOpinion1 = $opinion1->getId();
        $opinion1->setTitle('Opinion Title');
        $opinionDate = new DateTime('2023-05-20');
        $opinion1->setDate($opinionDate);
        $opinion1->setDescription('Opinion Description');
        $opinion1->setMedecin($medecin);
        $patient->addOpinion($opinion1);

        // Expected information structure
        $expectedInfo = [
            'id'        => $idPatient,
            'firstname' => 'John',
            'lastname'  => 'Doe',
            'adlibelle' => '123456789',
            'adcp'      => '12345',
            'adcity'    => 'Some City',
            'adcountry' => 'France',
            'stays'     => [
                [
                    'id' => 10,
                    'reason' => 'Reason for stay',
                    'description' => 'Description of stay',
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'etat' => 'Etat',
                    'speciality_id' => $idSpeciality,
                    'speciality_lib' => 'Speciality Name',
                    'medecin_id' => $idMedecin,
                    'medecin_firstname' => 'Dr. Firstname',
                    'medecin_lastname' => 'Lastname'
                ]
            ],
            'prescriptions' => [
                [
                    'id' => $idPrescription1, // Assuming prescription IDs are set
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'medecin_id' => $idMedecin,
                    'medecin_firstname' => 'Dr. Firstname',
                    'medecin_lastname' => 'Lastname',
                    'medications' => [
                        [
                            'id'        => $idMedication1,
                            'dosage'    => '10mg',
                            'drug_name' => 'Drug Name'
                        ]
                    ]
                ]
            ],
            'opinions' => [
                [
                    'id' => $idOpinion1,
                    'title' => 'Opinion Title',
                    'date' => $opinionDate->format('Y-m-d'),
                    'description' => 'Opinion Description',
                    'medecin_id' => $idMedecin,
                    'medecin_firstname' => 'Dr. Firstname',
                    'medecin_lastname' => 'Lastname'
                ]
            ]
        ];
        // Get all information from patient
        $actualInfo = $patient->getAllInformation();
        // dump('oooooooo');
        // dump($actualInfo);
        // Assert that the actual information matches the expected information
        $this->assertEquals($expectedInfo, $actualInfo);
    }
}
