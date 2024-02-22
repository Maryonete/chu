<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Entity\Patient;
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
        $this->now = new \DateTime("now");
    }


    public function load(ObjectManager $manager): void
    {
        $specialityName = [
            'Biologie', 'Cardiologie et Maladies Vasculaires',
            'Chirurgie de l\'Obésité', 'Chirurgie Dentaire', 'Chirurgie Digestive et Viscérale',
            'Chirurgie maxillo faciale', 'Chirurgie Ophtalmologique', 'Chirurgie ORL', 'Chirurgie Orthopédique',
            'Chirurgie Pédiatrique', 'Chirurgie Plastique Reconstructrice et Esthétique', 'Chirurgie Urologique',
            'Chirurgie Vasculaire', 'Explorations Endoscopiques', 'Gastro-entérologie et proctologie',
            'Institut du pied', 'Médecine et Gérontologie', 'Orthopédie', 'Pneumologie', 'Radiologie',
            'SOS Calculs Urinaires', 'SOS Genoux', 'Urgences Adulte et Enfant', 'Urgences retine - Ophtalmologie'
        ];
        $this->now = new \DateTime("now");
        // Spécialités
        $listSpe = [];
        foreach ($specialityName as $namespe) {
            $spe = new Speciality();
            $spe->setName($namespe)
                ->setDescription($this->faker->paragraphs(5, true));
            $listSpe[] = $spe;
            $manager->persist($spe);
        }

        // ADMIN
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->hashPassword($admin, 'test'));
        $admin->setFirstName('Admin');
        $admin->setLastName('Admin');
        $admin->setEmail('admin@studi.fr');
        $manager->persist($admin);

        // MEDECIN
        $medecins = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setRoles(['ROLE_MEDECIN']);
            // $user->setPassword($this->encoder->hashPassword($user, $this->faker->password()));
            $user->setPassword($this->encoder->hashPassword($user, 'test'));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);

            $user->setEmail($this->faker->email);
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
            // $user->setPassword($this->encoder->hashPassword($user, $this->faker->password()));
            $user->setPassword($this->encoder->hashPassword($user, 'test'));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setEmail($this->faker->email);

            // Adresse
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setAdLibelle($this->faker->streetAddress);
            $patient->setAdCp($this->faker->postcode);
            $patient->setAdCountry('FR');
            $patient->setAdCity($this->faker->city);
            $manager->persist($user);
            $manager->persist($patient);

            // sejour
            for ($k = 1; $k <= 4; $k++) {
                $sejour = new Stay();
                $sejour->setpatient($patient);
                $sejour->setReason($this->faker->sentence);
                $sejour->setDescription($this->faker->paragraph);
                $sejour->setSpeciality($this->faker->randomElement($listSpe));
                $sejour->setMedecin($this->faker->randomElement($medecins));


                if ($k < 3) {
                    $dateA = $this->faker->dateTimeBetween('+1 month', '+1 year');
                } else {
                    $dateA = $this->faker->dateTimeBetween('-1 year', '+1 year');
                }
                $dateB = $this->faker->dateTimeBetween('-1 year', '+1 year');

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
        $this->loadMedecinTest($manager);
        $this->loadCalendars($manager);
    }
    // Calendar : seulement pour le premier medecin
    private function loadCalendars(ObjectManager $manager): void
    {
        $userMedecin = $manager->getRepository(User::class)->findOneByEmail("medecin@studi.fr");
        $medecinStays = $manager->getRepository(Stay::class)->findBy([
            'medecin'      => $userMedecin->getMedecin(),
        ]);

        foreach ($medecinStays as $stay) {

            $stayStartDate = $stay->getStartDate();
            dump($stayStartDate);
            $stayEndDate    = $stay->getEndDate();

            // Créer une instance de Calendar
            $calendar = new Calendar();

            // Liez le Calendar au séjour et au médecin
            $calendar->setStay($stay);
            $calendar->setMedecin($userMedecin->getMedecin());

            // Définissez les autres attributs du Calendar en fonction des attributs du séjour
            $calendar->setTitle($stay->getpatient()->getUser()->getFirstname() . ' ' . $stay->getpatient()->getUser()->getLastname());
            $calendar->setDescription($stay->getReason());
            $calendar->setStart($stayStartDate);
            $calendar->setEnd($stayEndDate);

            // Persistez l'instance de Calendar
            $manager->persist($calendar);
        }
        $manager->flush();
    }
    // Medecin test pour api mobile
    private function loadMedecinTest(ObjectManager $manager): void
    {
        // 1. création du médecin test
        $user = new User();
        $user->setRoles(['ROLE_MEDECIN']);
        $user->setPassword($this->encoder->hashPassword($user, 'test'));
        $user->setFirstName($this->faker->firstName);
        $user->setLastName($this->faker->lastName);
        $user->setEmail('medecin@studi.fr');
        $manager->persist($user);

        $medecin = new Medecin();
        $medecin->setUser($user);


        // 2. ajout 6 specialités
        $speList = $manager->getRepository(Speciality::class)->findBy([], null, 6);

        // dump($spe);
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
            $user->setPassword($this->encoder->hashPassword($user, 'test'));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            // utilisé pour les tests
            if ($i == 1) {
                $email = "john.do@test.fr";
            } else {
                $email = $this->faker->email;
            }
            $user->setEmail($email);

            // Adresse
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setAdLibelle($this->faker->streetAddress);
            $patient->setAdCp($this->faker->postcode);
            $patient->setAdCountry('FR');
            $patient->setAdCity($this->faker->city);
            $manager->persist($user);
            $manager->persist($patient);

            // sejour
            for ($k = 1; $k <= 4; $k++) {
                $sejour = new Stay();
                $sejour->setpatient($patient);
                $sejour->setReason($this->faker->sentence);
                $sejour->setDescription($this->faker->paragraph);
                $sejour->setSpeciality($this->faker->randomElement($listeSpe));
                $sejour->setMedecin($medecin);


                // on enregistre au moins 1 séjours à venir, 2 passés et un en cours
                $dateNow = clone $this->now;
                switch ($k) {
                    case 1:
                        $dateA = $dateNow;
                        $dateB = $dateNow->modify('+1 week');
                        $sejour->setValidate(true);
                        break;
                    case 2:
                        $dateA = $dateNow->modify('-1 year');
                        $dateB = $dateNow->modify('-11 months');
                        break;
                    case 3:
                        $dateA = $dateNow->modify('-10 months');
                        $dateB = $dateNow->modify('-9 months');
                        break;
                    default:
                        $dateA = $dateNow->modify('+1 month');
                        $dateB = $dateNow->modify('+6 weeks');
                        $sejour->setValidate(true);
                        break;
                }

                $sejour->setStartDate($dateA);
                $sejour->setEndDate($dateB);

                $manager->persist($sejour);
            }
        }

        $manager->flush();
    }
}
// php bin/console doctrine:fixtures:load –append
