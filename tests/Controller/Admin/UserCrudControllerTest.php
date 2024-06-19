<?php

namespace App\Tests\Controller\Admin;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Controller\Admin\UserCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudControllerTest extends TestCase
{
    private UserCrudController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock du UserPasswordHasherInterface
        $userPasswordHasher = $this->createMock(UserPasswordHasherInterface::class);

        // Création de l'instance du contrôleur avec le mock
        $this->controller = new UserCrudController($userPasswordHasher);
    }
    public function testGetEntityFqcn(): void
    {
        $this->assertEquals(User::class, $this->controller->getEntityFqcn());
    }
}
