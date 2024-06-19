<?php

namespace App\Controller\Admin;

use App\Entity\Stay;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stay::class;
    }


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
    }
}
