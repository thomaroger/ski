<?php

namespace App\Controller\Admin;

use App\Entity\Monitor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MonitorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Monitor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            AssociationField::new('type')->autocomplete(),
        ];
    }
    
}
