<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Session;
use App\Entity\Content;


class MappingController extends AbstractController
{
    #[Route('/mapping', name: 'app_mapping')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $currentDate = new \DateTime(); 
        $interval = new \DateInterval('P1D');
        $currentDate->sub($interval);
        $datasessions = [];

        $sessions = $entityManager->getRepository(Session::class)->findBy(['cancel'=>false]);
        $content = $entityManager->getRepository(Content::class)->findOneBy([], array('id' => 'DESC'));


        foreach($sessions as $session) {
            if($session->getDate()->getDate() >= $currentDate) {
                $datasessions[$session->getDate()->getId()]['name'] = $session->getDate()->getFullString();
                $datasessions[$session->getDate()->getId()]['session'][$session->getId()]['name'] = $session->getGroupname().' : '.$session->getName().' avec '.$session->getMonitor()->__toString();
                $datasessions[$session->getDate()->getId()]['session'][$session->getId()]['test'] = $session->isTest();
                $datasessions[$session->getDate()->getId()]['session'][$session->getId()]['cancel'] = $session->isCancel();
                $datasessions[$session->getDate()->getId()]['session'][$session->getId()]['race'] = $session->isRace();
                $datasessions[$session->getDate()->getId()]['session'][$session->getId()]['additional'] = $session->isadditional();
                
            }
        }



        return $this->render('mapping/index.html.twig', [
            "page" => 'mapping',
            "datasessions" => $datasessions,
            "content" => $content,
        ]);
    }
}
