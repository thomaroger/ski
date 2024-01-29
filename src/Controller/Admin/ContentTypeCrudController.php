<?php

namespace App\Controller\Admin;

use App\Entity\ContentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContentType::class;
    }
}
