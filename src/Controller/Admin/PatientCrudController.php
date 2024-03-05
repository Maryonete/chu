<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PatientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Patient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('User')->setIcon('fa-regular fa-user'),
            AssociationField::new('user')->renderAsEmbeddedForm(UserCrudController::class),


            FormField::addTab('Adresse')->setIcon('fa-regular fa-book'),
            //         // from parent::configureFields($pageName),
            IdField::new('id')->hideOnForm(),
            TextField::new('adlibelle', 'Adresse'),
            TextField::new('adcp', 'CP'),
            TextField::new('adcity', 'Ville'),
            CountryField::new('adcountry', 'Pays')->showName(false),
        ];
    }
}
