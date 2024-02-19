<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use App\Entity\Speciality;
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
        }
        $manager->flush();
    }
}
// php bin/console doctrine:fixtures:load –append
