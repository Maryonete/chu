<?php

namespace App\Controller\Admin;

use App\Entity\Stay;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;

class StayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stay::class;
    }
    // #[Route('/admin/{id<\d+>}/stay/edit', name: 'admin_stay_edit')]
    // public function updateStay
    // (
    //     AdminContext $adminContext,
    //     EntityManagerInterface $entityManager,
    //     AdminUrlGenerator $adminUrlGenerator
    // ):Response 
    // {
    //     $stay = $adminContext->getEntity()->getInstance();
    //     if (!$stay instanceof Stay) {
    //         throw new \LogicException('Entity is missing or not a Stay');
    //     }

    //     $targetUrl = $adminUrlGenerator
    //         ->setController(self::class)
    //         ->setAction(Crud::PAGE_DETAIL)
    //         ->setEntityId($stay->getId())
    //         ->generateUrl();

    //     return $this->redirect($targetUrl);
    // }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('patient', 'Patient');
        yield AssociationField::new('speciality', 'Spécialité');
        yield AssociationField::new('medecin', 'Médecin');

        yield IdField::new('id')->hideOnForm();
        yield TextField::new('reason', 'Motif');
        yield DateField::new('start_date', 'Date de début')->setColumns(6);
        yield DateField::new('end_date', 'Date de fin')->setColumns(6);
        yield TextEditorField::new('description');

        // private ?string $etat = null;
    }
}
