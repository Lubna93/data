<?php

namespace App\Controller\Admin;

use App\Entity\Science;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Entity\Tag1;

use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class ScienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Science::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('body'),
            BooleanField::new('published', 'Publié?'),
            DateTimeField::new('createdat', 'Créé à')->hideOnForm(),
            AssociationField::new('Tag1')->hideOnIndex(),
            ArrayField::new('Tag1', 'Tags')->hideOnForm(),
            ImageField::new('Image', 'Image')
                ->setUploadDir('public/uploads/science')
                ->setBasePath('uploads/science')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')

        ];
    }
}
