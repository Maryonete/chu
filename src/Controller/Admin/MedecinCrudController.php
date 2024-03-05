<?php

namespace App\Controller\Admin;

use App\Entity\Medecin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MedecinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Medecin::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('User')->setIcon('fa-regular fa-user'),
            AssociationField::new('user')->renderAsEmbeddedForm(UserCrudController::class, 'firstname'),


            FormField::addTab('Spécialité')->setIcon('fa-regular fa-hospital'),
            //         // from parent::configureFields($pageName),
            AssociationField::new('speciality', 'Spécialité'),

        ];
    }
}
