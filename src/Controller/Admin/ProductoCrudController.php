<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('codigo'),
            TextField::new('descripcion_producto'),
            NumberField::new('precio'),
            IntegerField::new('stock'),
            IntegerField::new('iva'),
            NumberField::new('peso'),

            AssociationField::new('proveedor'),
            AssociationField::new('marca'),
            AssociationField::new('presentacion'),
            AssociationField::new('zona'),


        ];
    }
    
}
