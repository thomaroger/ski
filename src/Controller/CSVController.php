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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CSVController extends AbstractController
{
    #[Route('/c/s/v', name: 'app_c_s_v')]
    public function index(EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        die();
        $file = fopen('http://127.0.0.1:8000/csv/etoiles2.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {

            $html ='Bonjour,<br />';
            $html.=$line[1].' '.$line[0].' a obtenu : '.$line[2].'<br /><br />';
            $html.='Le ski club de bogève';

            $email = (new Email())
            ->from('thomaroger@gmail.com')
            ->to($line[3])
            ->cc('scbogeve.initiation@gmail.com')
            ->replyTo('scbogeve.initiation@gmail.com')
            ->subject("[SKI CLUB BOGEVE] Passage d'étoile - Mars 2024")
            ->html($html);


        $mailer->send($email);
        }
        fclose($file);

        die();
     
    }
}
