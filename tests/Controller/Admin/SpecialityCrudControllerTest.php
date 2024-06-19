<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\SpecialityCrudController;
use App\Entity\Speciality;
use PHPUnit\Framework\TestCase;

class SpecialityCrudControllerTest extends TestCase
{
    public function testGetEntityFqcn(): void
    {
        // Instanciation du contrôleur
        $controller = new SpecialityCrudController();

        // Appel de la méthode getEntityFqcn
        $entityFqcn = $controller::getEntityFqcn();

        // Vérification que le FQCN retourné est exactement celui de Speciality::class
        $this->assertEquals(Speciality::class, $entityFqcn);
    }
}
