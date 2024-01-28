<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Child;
use App\Entity\Group;
use App\Entity\Session;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        
        $groups = $entityManager->getRepository(Group::class)->findAll();
        
        return $this->render('home/index.html.twig', [
            "groups" => $groups,
        ]);
    }
}
