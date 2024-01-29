<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Entity\Child;
use App\Entity\Group;
use App\Entity\Monitor;
use App\Entity\Date;
use App\Entity\Club;
use App\Entity\TypeMonitor;
use App\Entity\Session;
use App\Entity\User;
use App\Entity\Content;
use App\Entity\ContentType;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
     
        return $this->render('admin/dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ski Club de Bogève et Viuz en Sallaz - Backoffice');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToUrl('Frontend', 'fa fa-globe', '/'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Users'),
            MenuItem::linkToCrud('Clubs', 'fa fa-flag', Club::class),
            MenuItem::linkToCrud('Groups', 'fa fa-users', Group::class),
            MenuItem::linkToCrud('Childs', 'fa fa-child', Child::class),
            MenuItem::section('Date'),
            MenuItem::linkToCrud('Dates', 'fa fa-clock', Date::class),
            MenuItem::section('Monitors'),
            MenuItem::linkToCrud('Monitors Type', 'fa-brands fa-watchman-monitoring', TypeMonitor::class),
            MenuItem::linkToCrud('Monitors', 'fa fa-user', Monitor::class),
            MenuItem::section('Session'),
            MenuItem::linkToCrud('Sessions', 'fa fa-person-skiing', Session::class), 
            MenuItem::section('Communication'),
            MenuItem::linkToCrud('ContentType', 'fa fa-palette', ContentType::class), 
            MenuItem::linkToCrud('Content', 'fa fa-bell', Content::class), 
            MenuItem::section('Security'),
            MenuItem::linkToCrud('User', 'fa fa-lock', User::class), 

         ];
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(30)
        ;
    }
}
