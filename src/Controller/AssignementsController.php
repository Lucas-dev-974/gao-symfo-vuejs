<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssignementsController extends AbstractController
{
    /**
     * @Route("/assignements", name="assignements")
     */
    public function index(): Response
    {
        return $this->render('assignements/index.html.twig', [
            'controller_name' => 'AssignementsController',
        ]);
    }
}
