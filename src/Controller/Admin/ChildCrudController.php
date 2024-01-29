<?php

namespace App\Controller\Admin;

use App\Entity\Child;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\SearchMode;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ChildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Child::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        

        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            AssociationField::new('groupname'),
            AssociationField::new('club'),
        ];
    }
    

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['lastname', 'firstname'])
            ->setSearchMode(SearchMode::ANY_TERMS)
        ;
    }
}
