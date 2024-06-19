<?php

namespace App\Tests\Repository;

use App\Entity\Drug;
use App\Entity\User;
use App\Entity\Drugs;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Medication;
use App\Entity\Prescription;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PrescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PrescriptionRepositoryTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;
    private ?PrescriptionRepository $prescriptionRepository;

    protected function setUp(): void
    {
        // Initialisation du kernel Symfony pour accéder aux services
        $kernel = self::bootKernel();

        // Récupération de l'EntityManager à partir du conteneur de services
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Récupération du PrescriptionRepository à partir du conteneur de services
        $this->prescriptionRepository = $this->entityManager->getRepository(Prescription::class);
    }

    public function testFindAllPrescriptionByPatient(): void
    {
        // Création d'un patient fictif
        $user = new User();
        $patient = new Patient();
        $user->setPatient($patient);
        $patient->getUser()
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setEmail('testFindAllPrescriptionByPatientpatient@studi.fr')
            ->setPassword('Azerty!22');
        $patient->setAdlibelle('123456789');
        $patient->setAdcp('12345');
        $patient->setAdcity('Some City');
        $patient->setAdcountry('France');

        $this->entityManager->persist($patient);

        // Création de médicaments fictifs
        $drug1 = new Drugs();
        $drug1->setName('Drug 1');
        $this->entityManager->persist($drug1);

        $drug2 = new Drugs();
        $drug2->setName('Drug 2');
        $this->entityManager->persist($drug2);

        // MEDECIN
        $user = new User();
        $medecin = new Medecin();
        $user->setMedecin($medecin);
        $medecin->getUser()->setFirstname('Dr. Firstname')
            ->setLastname('Lastname')
            ->setEmail('testFindAllPrescriptionByPatientmedecin@studi.fr')
            ->setPassword('Azerty1!');
        $this->entityManager->persist($medecin);

        // Création de prescriptions fictives
        $prescription1 = new Prescription();
        $prescription1->setPatient($patient);
        $prescription1->setStartDate(new \DateTime('2023-01-01'));
        $prescription1->setEndDate(new \DateTime('2023-01-02'));
        $prescription1->setMedecin($medecin);
        $this->entityManager->persist($prescription1);

        $prescription2 = new Prescription();
        $prescription2->setPatient($patient);
        $prescription2->setStartDate(new \DateTime('2023-02-01'));
        $prescription2->setEndDate(new \DateTime('2023-02-11'));
        $prescription2->setMedecin($medecin);
        $this->entityManager->persist($prescription2);

        // Création de medications fictives
        $medication1 = new Medication();
        $medication1->setDosage('10mg');
        $medication1->setPrescription($prescription1);
        $medication1->setDrug($drug1);
        $this->entityManager->persist($medication1);

        $medication2 = new Medication();
        $medication2->setDosage('20mg');
        $medication2->setPrescription($prescription2);
        $medication2->setDrug($drug2);
        $this->entityManager->persist($medication2);

        // Flusher toutes les entités
        $this->entityManager->flush();

        // Appel de la méthode à tester
        $result = $this->prescriptionRepository->findAllPrescriptionByPatient($patient->getId());

        // Assertions
        $this->assertCount(2, $result);
        $this->assertEquals($prescription2->getId(), $result[0]->getId()); // Prescription la plus récente en premier
        $this->assertEquals($prescription1->getId(), $result[1]->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Fermeture de l'EntityManager
        if ($this->entityManager !== null) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }
}
