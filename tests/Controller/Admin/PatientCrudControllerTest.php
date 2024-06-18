<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\PatientCrudController;
use App\Entity\Patient;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PHPUnit\Framework\TestCase;

class PatientCrudControllerTest extends TestCase
{
    public function testGetEntityFqcn(): void
    {
        $controller = new PatientCrudController();

        $this->assertEquals(Patient::class, $controller->getEntityFqcn());
    }

    public function testConfigureFields(): void
    {
        $controller = new PatientCrudController();

        // Appel de la méthode configureFields
        $fields = iterator_to_array($controller->configureFields(''));

        // Vérification des champs configurés
        $this->assertCount(8, $fields);

        // Vérification du premier champ : FormField 'User'
        $this->assertInstanceOf(FormField::class, $fields[0]);
        $this->assertEquals('User', $fields[0]->getAsDto()->getLabel());

        // Vérification du deuxième champ : AssociationField 'user'
        $this->assertInstanceOf(AssociationField::class, $fields[1]);
        $this->assertEquals('user', $fields[1]->getAsDto()->getProperty());

        // Vérification du troisième champ : FormField 'Adresse'
        $this->assertInstanceOf(FormField::class, $fields[2]);
        $this->assertEquals('Adresse', $fields[2]->getAsDto()->getLabel());

        // Vérification du quatrième champ : IdField 'id'
        $this->assertInstanceOf(IdField::class, $fields[3]);
        $this->assertEquals('id', $fields[3]->getAsDto()->getProperty());

        // Vérification du cinquième champ : TextField 'adlibelle'
        $this->assertInstanceOf(TextField::class, $fields[4]);
        $this->assertEquals('adlibelle', $fields[4]->getAsDto()->getProperty());
        $this->assertEquals('Adresse', $fields[4]->getAsDto()->getLabel());

        // Vérification du sixième champ : TextField 'adcp'
        $this->assertInstanceOf(TextField::class, $fields[5]);
        $this->assertEquals('adcp', $fields[5]->getAsDto()->getProperty());
        $this->assertEquals('CP', $fields[5]->getAsDto()->getLabel());

        // Vérification du septième champ : TextField 'adcity'
        $this->assertInstanceOf(TextField::class, $fields[6]);
        $this->assertEquals('adcity', $fields[6]->getAsDto()->getProperty());
        $this->assertEquals('Ville', $fields[6]->getAsDto()->getLabel());

        // Vérification du huitième champ : CountryField 'adcountry'
        $this->assertInstanceOf(CountryField::class, $fields[7]);
        $this->assertEquals('adcountry', $fields[7]->getAsDto()->getProperty());
        $this->assertEquals('Pays', $fields[7]->getAsDto()->getLabel());
    }
}
