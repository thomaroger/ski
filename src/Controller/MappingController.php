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
                $datasessions[$session->getDate()->__toString()][$session->getId()]['name'] = $session->getGroupname().' : '.$session->getName().' avec '.$session->getMonitor()->__toString();
                $datasessions[$session->getDate()->__toString()][$session->getId()]['test'] = $session->isTest();
                $datasessions[$session->getDate()->__toString()][$session->getId()]['cancel'] = $session->isCancel();
                $datasessions[$session->getDate()->__toString()][$session->getId()]['race'] = $session->isRace();
                $datasessions[$session->getDate()->__toString()][$session->getId()]['additional'] = $session->isadditional();
            }
        }



        return $this->render('mapping/index.html.twig', [
            "page" => 'mapping',
            "datasessions" => $datasessions,
            "content" => $content,
        ]);
    }
}
