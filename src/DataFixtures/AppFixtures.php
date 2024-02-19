<?php

namespace App\DataFixtures;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private Generator $faker;

    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');
        $this->encoder = $encoder;
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
        $now = new \DateTime("now");
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

            for ($j = 1; $j <= 6; $j++) {
                $medecin = new Medecin();
                $medecin->setUser($user);
                for ($k = 1; $k <= 6; $k++) {
                    $medecin->addSpeciality($this->faker->randomElement($listSpe));
                }
            }
            $manager->persist($medecin);

            $medecins[] = $medecin;
        }
        // USER
        for ($i = 1; $i <= 10; $i++) {
            $email = $this->faker->email;

            // utilisé pour les tests
            if ($i == 1) {
                $email = "john.do@test.fr";
            }

            $user = new User();
            $user->setRoles(['ROLE_USER']);
            // $user->setPassword($this->encoder->hashPassword($user, $this->faker->password()));
            $user->setPassword($this->encoder->hashPassword($user, 'test'));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setEmail($email);


            // Adresse
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setAdLibelle($this->faker->streetAddress);
            $patient->setAdCp($this->faker->postcode);
            // $patient->setAdCountry($this->faker->country);
            $patient->setAdCountry('FR');
            $patient->setAdCity($this->faker->city);
            $manager->persist($user);
            $manager->persist($patient);
            // sejour
            for ($k = 1; $k <= 10; $k++) {
                $sejour = new Stay();
                $sejour->setpatient($patient);
                $sejour->setReason($this->faker->sentence);
                $sejour->setDescription($this->faker->paragraph);
                $sejour->setSpeciality($this->faker->randomElement($listSpe));
                $sejour->setMedecin($this->faker->randomElement($medecins));

                // on enregistre au moins 2 séjours à venir
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
                if ($now > $sejour->getStartDate()) {
                    $sejour->setValidate(true);
                }
                $manager->persist($sejour);
            }
        }
        $manager->flush();
    }
}
// php bin/console doctrine:fixtures:load –append
