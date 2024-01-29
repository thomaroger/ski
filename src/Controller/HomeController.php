<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Child;
use App\Entity\Group;
use App\Entity\Session;
use App\Entity\Content;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        
        $groupsHeaders = [];
        $datasessions = []; 
        $filters = [];
        $currentDate = new \DateTime(); 
        $interval = new \DateInterval('P1D');
        $currentDate->sub($interval);

        $postChild = $request->getPayload()->get('child', 0);
        $postGroup = $request->getPayload()->get('group', 0);

        if(!empty($postChild)) {
            $child = $entityManager->getRepository(Child::class)->find($postChild);
            $filters['Groupname'] = $child->getGroupname();
            $postGroup = $filters['Groupname']->getId();
        }


        if(!empty($postGroup)) {
            $filters['Groupname'] = $entityManager->getRepository(Group::class)->find($postGroup);
        }


        $groups = $entityManager->getRepository(Group::class)->findBy([], array('name' => 'ASC'));
        $children = $entityManager->getRepository(Child::class)->findBy([], array('lastname' => 'ASC'));
        $sessions = $entityManager->getRepository(Session::class)->findBy($filters, array('date' => 'ASC'));
        $content = $entityManager->getRepository(Content::class)->findOneBy([], array('id' => 'DESC'));

        foreach($sessions as $session) {
            if($session->getDate()->getDate() >= $currentDate) {
                $groupsHeaders[$session->getGroupname()->getId()] = $session->getGroupname()->__toStringForFront();
                $datasessions[$session->getDate()->getId()][$session->getGroupname()->getId()]['name'] = $session->getName().' : '.$session->getMonitor()->__toString();
                $datasessions[$session->getDate()->getId()][$session->getGroupname()->getId()]['test'] = $session->isTest();
                $datasessions[$session->getDate()->getId()][$session->getGroupname()->getId()]['cancel'] = $session->isCancel();
                $datasessions[$session->getDate()->getId()][$session->getGroupname()->getId()]['race'] = $session->isRace();
                $datasessions[$session->getDate()->getId()][$session->getGroupname()->getId()]['additional'] = $session->isadditional();
                $datasessions[$session->getDate()->getId()]['date'] = $session->getDate()->getFullString();
            }
        }
        asort($groupsHeaders);
        foreach($datasessions as $key => $session) {
            asort($session);
        }

        return $this->render('home/index.html.twig', [
            "page" => 'home',
            "groups" => $groups,
            "children" => $children,
            "groupsHeaders" => $groupsHeaders,
            "datasessions" => $datasessions,
            "postChild" => $postChild,
            "postGroup" => $postGroup,
            "content" => $content,
        ]);
    }

   
}
