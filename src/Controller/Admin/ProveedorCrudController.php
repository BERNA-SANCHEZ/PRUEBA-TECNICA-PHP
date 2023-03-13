<?php

namespace App\Controller\Admin;

use App\Entity\Proveedor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProveedorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Proveedor::class;
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
