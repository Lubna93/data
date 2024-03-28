<?php

namespace App\Controller\Admin;

use App\Entity\Tag1;
use App\Entity\Science;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class Tag1CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag1::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titret', 'Titre')->setRequired(true),
        ];
    }

}
