<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class AppFixtures extends Fixture
{


    private Generator $faker;


    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
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

        $manager->flush();
    }
}
// php bin/console doctrine:fixtures:load –append
