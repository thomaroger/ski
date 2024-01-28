<?php

namespace App\Controller\Admin;

use App\Entity\TypeMonitor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeMonitorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeMonitor::class;
    }
}
