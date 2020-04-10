<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Entity\Schedule;
use App\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Datetime;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $days =array("D", "L", "M", "X", "J", "V", "S");
        $day=$days[date("w",time())];
        $cdate= new Datetime('now');
        $s = date("H:i",time());

        $session = $em->getRepository(Session::class)->getCurrentSessionID($s);
        $qAbsences = $em->getRepository(Absence::class)->getAbsences($cdate,$session);
        $qWatchT = $em->getRepository(Schedule::class)->getWatchTeachers($day,$session);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'created_by' => 'Jose C. Molina',
            'twatches' => $qWatchT,
            'tabsences' => $qAbsences,
        ]);
    }
}
