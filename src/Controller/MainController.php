<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $query=findAbsencedTeacher($day,$session);
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'created_by' => 'Jose C. Molina',
        ]);
    }
}
