<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TraiterController extends AbstractController
{
    #[Route('/traiter', name: 'app_traiter')]
    public function index(): Response
    {
        return $this->render('traiter/index.html.twig', [
            'controller_name' => 'TraiterController',
        ]);
    }
}
