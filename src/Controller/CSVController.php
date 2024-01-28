<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Group;
use App\Entity\Session;
use App\Entity\Date;
use App\Entity\Monitor;

class CSVController extends AbstractController
{
    #[Route('/c/s/v', name: 'app_c_s_v')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        die;
    }
}
