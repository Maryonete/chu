<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\MedecinCrudController;
use App\Entity\Medecin;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use PHPUnit\Framework\TestCase;

class MedecinCrudControllerTest extends TestCase
{
    public function testGetEntityFqcn(): void
    {
        $controller = new MedecinCrudController();

        $this->assertEquals(Medecin::class, $controller->getEntityFqcn());
    }

    public function testConfigureFields(): void
    {
        $controller = new MedecinCrudController();

        // Appel de la méthode configureFields
        $fields = iterator_to_array($controller->configureFields(''));

        // Vérification des champs configurés
        $this->assertCount(4, $fields);

        // Vérification du premier champ : FormField 'User'
        $this->assertInstanceOf(FormField::class, $fields[0]);
        $this->assertEquals('User', $fields[0]->getAsDto()->getLabel());

        // Vérification du deuxième champ : AssociationField 'user'
        $this->assertInstanceOf(AssociationField::class, $fields[1]);
        $this->assertEquals('user', $fields[1]->getAsDto()->getProperty());

        // Vérification du troisième champ : FormField 'Spécialité'
        $this->assertInstanceOf(FormField::class, $fields[2]);
        $this->assertEquals('Spécialité', $fields[2]->getAsDto()->getLabel());

        // Vérification du quatrième champ : AssociationField 'speciality'
        $this->assertInstanceOf(AssociationField::class, $fields[3]);
        $this->assertEquals('speciality', $fields[3]->getAsDto()->getProperty());
        $this->assertEquals('Spécialité', $fields[3]->getAsDto()->getLabel());
    }
}
