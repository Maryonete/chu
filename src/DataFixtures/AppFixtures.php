<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Drugs;
use App\Entity\Medecin;
use App\Entity\Medication;
use App\Entity\Opinions;
use App\Entity\Patient;
use App\Entity\Prescription;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $encoder;
    private DateTime $now;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');
        $this->encoder = $encoder;
        $this->now = new DateTime("now");
    }


    public function load(ObjectManager $manager): void
    {
        $specialityData = [
            'Biologie', 'Cardiologie et Maladies Vasculaires',
            'Chirurgie Dentaire',
            'Chirurgie Ophtalmologique',
            'Chirurgie ORL', 'Chirurgie Orthopédique',
            'Chirurgie Pédiatrique',
            'Chirurgie Vasculaire',
            'Gastro-entérologie et proctologie',
            'Institut du pied', 'Médecine et Gérontologie',
            'Orthopédie', 'Pneumologie', 'Radiologie',
            'Urgences Adulte et Enfant'
        ];
        $this->now = new \DateTime("now");
        // Spécialités
        $listSpe = [];
        foreach ($specialityData as $namespe) {
            $spe = new Speciality();
            $spe->setName($namespe)
                ->setDescription($this->faker->paragraphs(5, true));
            $listSpe[] = $spe;
            $manager->persist($spe);
        }

        // ADMIN
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->hashPassword($admin, 'Bx?U86!eadm'));
        $admin->setFirstName('Admin');
        $admin->setLastName('Admin');
        $admin->setEmail('admin@studi.fr');
        $manager->persist($admin);

        // SECRETAIRE
        $staff = new User();
        $staff->setRoles(['ROLE_STAFF']);
        $staff->setPassword($this->encoder->hashPassword($staff, 'Bx?U86!estaf'));
        $staff->setFirstName('staff');
        $staff->setLastName('Secretaire');
        $staff->setEmail('staff@studi.fr');
        $manager->persist($staff);

        // MEDECIN
        $medecins = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setRoles(['ROLE_MEDECIN']);
            // $user->setPassword($this->encoder->hashPassword($user, $this->faker->password()));
            $user->setPassword($this->encoder->hashPassword($user, 'Bx?U86!edoc'));
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());

            $user->setEmail($this->faker->email());
            $manager->persist($user);

            $medecin = new Medecin();
            $medecin->setUser($user);
            for ($k = rand(1, 6); $k <= 6; $k++) {
                $medecin->addSpeciality($this->faker->randomElement($listSpe));
            }
            $manager->persist($medecin);

            $medecins[] = $medecin;
        }
        // USER
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->hashPassword($user, 'Bx?U86!epat'));
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
            $user->setEmail($this->faker->email());

            // Adresse
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setAdLibelle($this->faker->streetAddress());
            $patient->setAdCp($this->faker->postcode());
            $patient->setAdCountry('FR');
            $patient->setAdCity($this->faker->city());
            $manager->persist($user);
            $manager->persist($patient);

            // sejour
            for ($k = 1; $k <= 4; $k++) {
                $sejour = new Stay();
                $sejour->setpatient($patient);
                $sejour->setReason($this->faker->sentence());
                $sejour->setDescription($this->faker->paragraph());
                $sejour->setSpeciality($this->faker->randomElement($listSpe));
                $sejour->setMedecin($this->faker->randomElement($medecins));

                # 3 à venir
                $dateB = $this->faker->dateTimeBetween('-1 year', '+1 year');
                if ($k < 3) {
                    $dateA = $this->faker->dateTimeBetween('+1 month', '+1 year');
                } else if ($k == 4) {
                    $dateA = $this->faker->dateTimeBetween('-10 days', '-3 days');
                    $dateB = new DateTime();
                } else {
                    $dateA = $this->faker->dateTimeBetween('-1 year', '+1 year');
                }

                if ($dateA < $dateB) {
                    $sejour->setStartDate($dateA);
                    $sejour->setEndDate($dateB);
                } else {
                    $sejour->setStartDate($dateB);
                    $sejour->setEndDate($dateA);
                }
                if ($this->now > $sejour->getStartDate()) {
                    $sejour->setValidate(true);
                }

                $sejour->setStartDate($dateA);
                $sejour->setEndDate($dateB);

                $manager->persist($sejour);
            }
        }
        $manager->flush();
        $this->loadDrugs($manager);
        $this->loadMedecinTest($manager, '');
        $this->loadCalendars($manager, '');

        $this->loadMedecinTest($manager, '1');
        $this->loadCalendars($manager, '1');

        $this->loadMedecinTest($manager, '2');
        $this->loadCalendars($manager, '2');
    }
    // Drugs
    private function loadDrugs(ObjectManager $manager): void
    {
        $drugsData = ['Doliprane', 'Peniciline', 'Vitamine', 'Maalox', 'Ibuprofène', 'Amoxicilline'];

        foreach ($drugsData as $drugData) {
            $drug = new Drugs();
            $drug->setName($drugData);
            $manager->persist($drug);
        }
        $manager->flush();
    }
    // Calendar : seulement pour le premier medecin
    private function loadCalendars(ObjectManager $manager, $email): void
    {
        $userMedecin = $manager->getRepository(User::class)->findOneByEmail($email . 'medecin@studi.fr');
        $medecinStays = $manager->getRepository(Stay::class)->findBy([
            'medecin'      => $userMedecin->getMedecin(),
        ]);
        // Nombre d'heures à ajouter
        $heure = 0;
        $minutes = 0;
        foreach ($medecinStays as $stay) {

            $stayStartDate = $stay->getStartDate();
            $stayEndDate   = $stay->getEndDate();

            // Créer une instance de Calendar
            $calendar = new Calendar();

            // Liez le Calendar au séjour et au médecin
            $calendar->setStay($stay);
            $calendar->setMedecin($userMedecin->getMedecin());

            // Définissez les autres attributs du Calendar en fonction des attributs du séjour
            $calendar->setTitle($stay->getpatient()->getUser()->getFirstname() . ' ' . $stay->getpatient()->getUser()->getLastname());
            $calendar->setDescription($stay->getReason());
            $calendar->setStart($stayStartDate->modify('+' . (9 + $heure) . ' hours'));
            $calendar->setEnd($stayEndDate->modify('+' . (14 + $heure) . ' hours'));
            if ($stayStartDate >= $this->now) {
                $heure++;
            }

            // Persistez l'instance de Calendar
            $manager->persist($calendar);
        }
        $manager->flush();
    }
    // Medecin test pour api mobile
    private function loadMedecinTest(ObjectManager $manager, String $nb): void
    {

        // 1. création du médecin test
        $user = new User();
        $user->setRoles(['ROLE_MEDECIN']);
        $user->setPassword($this->encoder->hashPassword($user, 'Bx?U86!edoc'));
        $user->setFirstName($this->faker->firstName());
        $user->setLastName($this->faker->lastName());
        $user->setEmail($nb . 'medecin@studi.fr');
        $manager->persist($user);
        $medecin = new Medecin();
        $medecin->setUser($user);


        // 2. ajout 6 specialités
        $speList = $manager->getRepository(Speciality::class)->findBy([], null, 6);

        $listeSpe = [];
        foreach ($speList as $spe) {
            $medecin->addSpeciality($spe);
            $listeSpe[] = $spe;
        }
        $manager->persist($medecin);

        // 3. Ajout des patients
        for ($i = 1; $i <= 5; $i++) {

            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->hashPassword($user, 'Bx?U86!epat'));
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
            // utilisé pour les tests
            if ($i == 1) {
                $email = $nb . "john.do@test.fr";
            } else {
                $email = $this->faker->email();
            }
            $user->setEmail($email);

            // Adresse
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setAdLibelle($this->faker->streetAddress());
            $patient->setAdCp($this->faker->postcode());
            $patient->setAdCountry('FR');
            $patient->setAdCity($this->faker->city());
            $manager->persist($user);
            $manager->persist($patient);

            // sejour
            for ($k = 1; $k <= 4; $k++) {
                $sejour = new Stay();
                $sejour->setpatient($patient);
                $sejour->setReason($this->faker->sentence());
                $sejour->setDescription($this->faker->paragraph());
                $sejour->setSpeciality($this->faker->randomElement($listeSpe));
                $sejour->setMedecin($medecin);

                // on enregistre au moins 1 séjours à venir, 2 passés et un en cours
                $dateNow = clone $this->now;
                if ($nb === '' or $nb === '2') {
                    switch ($k) {
                        case 1:
                            $dateA = clone $dateNow;
                            $dateB = clone $dateNow->modify('+1 week');
                            $sejour->setValidate(true);
                            break;
                        case 2:
                            $dateA = clone $dateNow->modify('-1 year');
                            $dateB = clone $dateNow->modify('-11 months');
                            break;
                        case 3:
                            $dateA = clone $dateNow->modify('-2 week');
                            $dateB = clone $dateNow->modify('-1 week');
                            $sejour->setValidate(true);
                            // dump('A: %s - B: %s', $dateA, $dateB);
                            break;
                        default:
                            $dateA = clone $dateNow->modify('+1 month');
                            $dateB = clone $dateNow->modify('+6 weeks');
                            $sejour->setValidate(true);
                            break;
                    }
                } else {
                    switch ($k) {
                        case 1:
                            $dateA = clone $dateNow->modify('-2 day');
                            $dateB = clone $dateNow->modify('+1 week');
                            $sejour->setValidate(true);
                            break;
                        case 2:
                            $dateA = clone $dateNow->modify('-1 year');
                            $dateB = clone $dateNow->modify('-11 months');
                            break;
                        case 3:
                            $dateA = clone $dateNow->modify('-1 week');
                            $dateB = new DateTime();
                            $sejour->setValidate(true);
                            // dump('A: %s - B: %s', $dateA, $dateB);
                            break;
                        default:
                            $dateA = clone $dateNow->modify('+1 month');
                            $dateB = clone $dateNow->modify('+6 weeks');
                            $sejour->setValidate(true);
                            break;
                    }
                }



                $sejour->setStartDate($dateA->setTime(0, 0, 0));
                $sejour->setEndDate($dateB->setTime(0, 0, 0));
                $manager->persist($sejour);

                // 4. ajout des prescriptions : 1 par patient
                $drugsList = $manager->getRepository(Drugs::class)->findBy([], null, 3);
                $nbJour = rand(1, 14);
                $prescription = new Prescription();
                $dateNow = clone $this->now;
                $dateB = clone $dateNow->modify('+' . $nbJour . ' day');
                $prescription->setStartDate($this->now);
                $prescription->setEndDate($dateB);
                $prescription->setPatient($patient);
                $prescription->setMedecin($medecin);


                // Medicament de la prescription
                foreach ($drugsList as $drug) {
                    $medication = new Medication();
                    $medication->setDrug($drug); // Utilisation de setDrug au lieu de addDrug
                    $medication->setDosage($this->faker->sentence());
                    $manager->persist($medication);

                    // Ajout de la médication à la prescription
                    $prescription->addMedication($medication);
                }

                $manager->persist($prescription);

                // 5. ajout des avis
                $nbJour = rand(1, 14);
                $dateNow = clone $this->now;
                $opinion = new Opinions();
                $opinion->setPatient($patient);
                $opinion->setMedecin($medecin);
                $opinion->setTitle($this->faker->sentence());
                $opinion->setDescription($this->faker->paragraph());
                $opinion->setDate(clone $dateNow->modify('+' . $nbJour . ' day'));
                $manager->persist($opinion);
            }
        }

        $manager->flush();
    }
}
// php bin/console doctrine:fixtures:load –append
