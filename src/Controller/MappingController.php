<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Session;

class MappingController extends AbstractController
{
    #[Route('/mapping', name: 'app_mapping')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $currentDate = new \DateTime(); 
        $interval = new \DateInterval('P1D');
        $currentDate->sub($interval);
        $datasessions = [];

        $sessions = $entityManager->getRepository(Session::class)->findAll();

        foreach($sessions as $session) {
            if($session->getDate()->getDate() >= $currentDate) {
                $datasessions[$session->getDate()->__toString()][] = $session->getGroupname().' : '.$session->getName().' avec '.$session->getMonitor()->__toString();
            }
        }



        return $this->render('mapping/index.html.twig', [
            "page" => 'mapping',
            "datasessions" => $datasessions,

        ]);
    }
}
