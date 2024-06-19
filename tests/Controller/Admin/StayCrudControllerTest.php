<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\StayCrudController;
use App\Entity\Stay;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PHPUnit\Framework\TestCase;

class StayCrudControllerTest extends TestCase
{
    public function testGetEntityFqcn(): void
    {
        $controller = new StayCrudController();

        $this->assertEquals(Stay::class, $controller->getEntityFqcn());
    }

    public function testConfigureFields(): void
    {
        $controller = new StayCrudController();

        // Appel de la méthode configureFields
        $fields = iterator_to_array($controller->configureFields(''));

        // Vérification des champs configurés
        $this->assertCount(8, $fields);

        // Vérification du premier champ : AssociationField 'patient'
        $this->assertInstanceOf(AssociationField::class, $fields[0]);
        $this->assertEquals('patient', $fields[0]->getAsDto()->getProperty());

        // Vérification du deuxième champ : AssociationField 'speciality'
        $this->assertInstanceOf(AssociationField::class, $fields[1]);
        $this->assertEquals('speciality', $fields[1]->getAsDto()->getProperty());

        // Vérification du troisième champ : AssociationField 'medecin'
        $this->assertInstanceOf(AssociationField::class, $fields[2]);
        $this->assertEquals('medecin', $fields[2]->getAsDto()->getProperty());

        // Vérification du quatrième champ : IdField 'id'
        $this->assertInstanceOf(IdField::class, $fields[3]);
        $this->assertEquals('id', $fields[3]->getAsDto()->getProperty());

        // Vérification du cinquième champ : TextField 'reason'
        $this->assertInstanceOf(TextField::class, $fields[4]);
        $this->assertEquals('reason', $fields[4]->getAsDto()->getProperty());

        // Vérification du sixième champ : DateField 'start_date'
        $this->assertInstanceOf(DateField::class, $fields[5]);
        $this->assertEquals('start_date', $fields[5]->getAsDto()->getProperty());

        // Vérification du septième champ : DateField 'end_date'
        $this->assertInstanceOf(DateField::class, $fields[6]);
        $this->assertEquals('end_date', $fields[6]->getAsDto()->getProperty());

        // Vérification du huitième champ : TextEditorField 'description'
        $this->assertInstanceOf(TextEditorField::class, $fields[7]);
        $this->assertEquals('description', $fields[7]->getAsDto()->getProperty());
    }
}
