<?php

namespace App\Controller\Admin;

use App\Entity\Label;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LabelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Label::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
