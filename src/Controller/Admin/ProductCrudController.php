<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

	public function configureActions(Actions $actions): Actions
	{
		return $actions
			// ...
			->add(Crud::PAGE_INDEX, Action::DETAIL)
			->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
			->add(Crud::PAGE_INDEX, Action::new('archiveProduct')->displayIf(static function ($entity) {
				return $entity->getDeletedAt()==null;
			})->linkToCrudAction('archiveProduct'))
			->add(Crud::PAGE_INDEX, Action::new('unarchiveProduct')->displayIf(static function ($entity) {
				return $entity->getDeletedAt()!=null;
			})->linkToCrudAction('unarchiveProduct'))
		;
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

	public function archiveProduct(AdminContext $context, EntityManagerInterface $em)
    {
        $product = $context->getEntity()->getInstance();
		$product->setDeletedAt(new \DateTimeImmutable());
		parent::updateEntity($em, $product);
		return $this->redirectToRoute('admin');
    }

	public function unarchiveProduct(AdminContext $context, EntityManagerInterface $em)
    {
        $product = $context->getEntity()->getInstance();
		$product->setDeletedAt(null);
		parent::updateEntity($em, $product);
		return $this->redirectToRoute('admin');
    }
}
