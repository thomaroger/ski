<?php
die;
/*
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
        $rowNo = 0;
           // $fp is file pointer to file sample.csv
        if (($fp = fopen("https://ski.thomaroger.fr/img/sessions.csv", "r")) !== FALSE) {
            while (($row = fgetcsv($fp, 1000, ",")) !== FALSE) {
                $num = count($row);
                $rowNo++;
                $datestring = $row[0];
                $datestringarray = explode(" ",$datestring);
                var_dump($datestringarray); 
                $day = $datestringarray[1];
                if($datestringarray[2] == 'fevrier') {
                    $month = '02';
                } 
                if($datestringarray[2] == 'janvier') {
                    $month = '01';
                } 
                if($datestringarray[2] == 'mars') {
                    $month = '03';
                } 
                //2024-03-24
                $datestring = '2024-'.$month.'-'.$day;

                $date = $entityManager->getRepository(Date::class)->findOneByDate(new \DateTime($datestring));

                echo "Date : ".$datestring." > ".$date->getId()."<br />";



                for ($c=1; $c < $num; $c++) {
                    if($c == 16)
                        continue;
                    
                    if(empty($row[$c]))
                            continue;  

                    if($row[$c] == 'Horaire à définir')
                        continue;
                    if($row[$c] == 'Horaire à définir (AP)')
                        continue;

                    $group = $entityManager->getRepository(Group::class)->find($c);
                    echo "Group : ".$group." > ".$group->getId()."<br />";

                     
                    
                    $sessionsarray = explode(":", $row[$c]);
                    var_dump($sessionsarray);
                    $name = $sessionsarray[0];
                    $monitor = $entityManager->getRepository(Monitor::class)->findOneByFirstname(trim($sessionsarray[1]));
                    echo "Monitor : ".$sessionsarray[1]." > ".$monitor->getId()."<br />";

                    echo "Heure : ".$name;

                    var_dump($sessionsarray);


                    $session = new Session();
                    $session->setName($name);
                    $session->setDate($date);
                    $session->setMonitor($monitor);
                    $session->setGroupname($group);
                    $session->setTest(false);
                    $entityManager->persist($session);
                    $entityManager->flush();


                }
            }
            fclose($fp);
        }
           die;
    }
}*/
