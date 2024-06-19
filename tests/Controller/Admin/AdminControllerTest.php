<?php

namespace App\Tests\Controller\Admin;

use PHPUnit\Framework\TestCase;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;

class AdminControllerTest extends TestCase
{
    // public function testIndexAction()
    // {
    //     $controller = new AdminController();

    //     $response = $controller->index();

    //     $this->assertInstanceOf(Response::class, $response);
    //     $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    // }
    public function testConfigureMenuItems(): void
    {
        // Création d'une instance du contrôleur
        $controller = new AdminController();

        // Récupération des éléments de menu configurés
        $menuItems = iterator_to_array($controller->configureMenuItems(''));

        // Vérification du nombre d'éléments de menu
        $this->assertCount(13, $menuItems);

        // Vérification du premier élément de menu
        // $this->assertInstanceOf(MenuItem::class, $menuItems[0]);

        // Vérification du titre et de l'icône de l'accueil
        $dashboardDto = $menuItems[0]->getAsDto();
        $this->assertEquals('Accueil', $dashboardDto->getLabel());
        $this->assertEquals('fa fa-home', $dashboardDto->getIcon());

        // Vérification de l'élément de menu 'Séjours'
        // $this->assertInstanceOf(MenuItem::class, $menuItems[1]);
        $this->assertEquals('Séjours', $menuItems[1]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[1]->getAsDto()->getIcon());
        // $this->assertEquals('Stay', $menuItems[1]->getEntityFqcn()); // Vérifiez le FQCN de l'entité

        // Vérification de la section 'Médecin' et de ses sous-menus
        //$this->assertInstanceOf(MenuItem::class, $menuItems[2]);
        $this->assertEquals('Médecin', $menuItems[2]->getAsDto()->getLabel());
        $this->assertEquals('fa-solid fa-user-nurse', $menuItems[2]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Nouveau' dans 'Médecin'
        $this->assertEquals('Nouveau', $menuItems[3]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[3]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Liste' dans 'Médecin'
        $this->assertEquals('Liste', $menuItems[4]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[4]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Agenda'
        $this->assertEquals('Agenda', $menuItems[5]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[5]->getAsDto()->getIcon());

        // Vérification de la section 'Patient'
        $this->assertEquals('Patient', $menuItems[6]->getAsDto()->getLabel());
        $this->assertEquals('fa-solid fa-head-side-cough', $menuItems[6]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Liste' dans 'Patient'
        $this->assertEquals('Liste', $menuItems[7]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[7]->getAsDto()->getIcon());

        // Vérification de la section 'Spécialités'
        $this->assertEquals('Spécialités', $menuItems[8]->getAsDto()->getLabel());
        $this->assertEquals('fa-regular fa-hospital', $menuItems[8]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Création' dans 'Spécialités'
        $this->assertEquals('Création', $menuItems[9]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[9]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Liste' dans 'Spécialités'
        $this->assertEquals('Liste', $menuItems[10]->getAsDto()->getLabel());
        $this->assertEquals('', $menuItems[10]->getAsDto()->getIcon());

        // Vérification de la section 'Outils'
        $this->assertEquals('Outils', $menuItems[11]->getAsDto()->getLabel());
        $this->assertEquals('fa-solid fa-gear', $menuItems[11]->getAsDto()->getIcon());

        // Vérification de l'élément de menu 'Logout' dans 'Outils'
        $this->assertEquals('Logout', $menuItems[12]->getAsDto()->getLabel());
        $this->assertEquals('fa-solid fa-right-from-bracket', $menuItems[12]->getAsDto()->getIcon());
    }
}
