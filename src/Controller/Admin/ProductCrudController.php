<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
			IdField::new('id')->hideOnForm(),
			AssociationField::new('brand')->hideWhenUpdating(),
			AssociationField::new('category')->hideWhenUpdating(),
			TextField::new('name')->hideWhenUpdating(),
			ImageField::new('image')->setUploadDir('public/image/')->setUploadedFileNamePattern('[uuid]_[timestamp].[extension]')->hideWhenUpdating(),
            NumberField::new('price')->setNumDecimals(2),
			DateTimeField::new('created_at')->hideOnForm(),
			DateTimeField::new('updated_at')->hideOnForm(),
			DateTimeField::new('deleted_at')->hideOnForm(),
        ];
    }
}
