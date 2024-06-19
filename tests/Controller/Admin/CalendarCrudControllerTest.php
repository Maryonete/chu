<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\CalendarCrudController;
use App\Entity\Calendar;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CalendarCrudControllerTest extends KernelTestCase
{
    public function testGetEntityFqcn(): void
    {
        $controller = new CalendarCrudController();

        $this->assertEquals(Calendar::class, $controller->getEntityFqcn());
    }
    public function testConfigureFields(): void
    {
        $controller = new CalendarCrudController();

        $fields = iterator_to_array($controller->configureFields('index'));

        $this->assertCount(4, $fields);

        // Vérification des champs retournés
        $this->assertInstanceOf(IdField::class, $fields[0]);
        $this->assertInstanceOf(TextField::class, $fields[1]);
        $this->assertInstanceOf(AssociationField::class, $fields[2]);
        $this->assertInstanceOf(TextEditorField::class, $fields[3]);

        // Vérification des propriétés spécifiques des champs
        /** @var IdField $idField */
        $idField = $fields[0];
        $this->assertEquals('id', $idField->getAsDto()->getProperty());

        /** @var TextField $titleField */
        $titleField = $fields[1];
        $this->assertEquals('title', $titleField->getAsDto()->getProperty());

        /** @var AssociationField $medecinField */
        $medecinField = $fields[2];
        $this->assertEquals('medecin', $medecinField->getAsDto()->getProperty());
        $this->assertEquals('Médecins', $medecinField->getAsDto()->getLabel());

        /** @var TextEditorField $descriptionField */
        $descriptionField = $fields[3];
        $this->assertEquals('description', $descriptionField->getAsDto()->getProperty());
    }
}
