<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/error', name: 'app_error')]
    public function index(): Response
    {
        return $this->render('error/index.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

    #[Route('/access_denied', name: 'access_denied')]
    public function denied(): Response
    {
        return $this->render('error/denied.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

    #[Route('/enconstruction', name: 'app_construct')]
    public function construct(): Response
    {
        return $this->render('error/construct.html.twig', [
            'controller_name' => 'EnConstruction',
        ]);
    }
}
