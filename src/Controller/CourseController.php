<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Session;
use App\Entity\Content;
use App\Entity\Monitor;
use Symfony\Component\HttpFoundation\Request;


class CourseController extends AbstractController
{
    #[Route('/course', name: 'app_course')]
    public function index(EntityManagerInterface $entityManager,Request $request): Response
    {
        $currentDate = new \DateTime(); 
        $interval = new \DateInterval('P1D');
        $currentDate->sub($interval);
        $datasessions = [];
        $sessionsFilters = [];
        $sessionsFilters['cancel'] = false; 

        $postMonitor = $request->getPayload()->get('monitor', 0);
        if(!empty($postMonitor)) {
            $sessionsFilters['monitor'] = $entityManager->getRepository(Monitor::class)->find($postMonitor);
        } 

        $monitors = $entityManager->getRepository(Monitor::class)->findAll();
        $content = $entityManager->getRepository(Content::class)->findOneBy([], array('id' => 'DESC'));
        $sessions = $entityManager->getRepository(Session::class)->findBy($sessionsFilters);


       




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



        return $this->render('course/index.html.twig', [
            "page" => 'course',
            "datasessions" => $datasessions,
            "content" => $content,
            "monitors" => $monitors,
            'postMonitor' => $postMonitor,
        ]);
    }
}
