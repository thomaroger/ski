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

class GroupController extends AbstractController
{
    #[Route('/group', name: 'app_group')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $groupsHeaders = [];
        $datasessions = []; 
        $filters = [];

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

        $groups = $entityManager->getRepository(Group::class)->findAll();
        $children = $entityManager->getRepository(Child::class)->findAll();
        $sessions = $entityManager->getRepository(Session::class)->findBy($filters);

        foreach($sessions as $session) {
            $groupsHeaders[$session->getGroupname()->getId()] = $session->getGroupname()->__toStringForFront();
            $datasessions[$session->getDate()->__toString()][$session->getGroupname()->getId()] = $session->getName().' : '.$session->getMonitor()->__toString();
        }

        return $this->render('home/groups.html.twig', [
            "page" => 'group',
            "groups" => $groups,
            "children" => $children,
            "groupsHeaders" => $groupsHeaders,
            "datasessions" => $datasessions,
            "postChild" => $postChild,
            "postGroup" => $postGroup,
        ]);
    }
}
