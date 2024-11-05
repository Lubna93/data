<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function index(): Response
    {
        return $this->render('legal/index.html.twig', [
            'controller_name' => 'LegalController',
        ]);
    }
    #[Route('/accessibilite', name: 'app_access')]
    public function access(): Response
    {
        return $this->render('legal/access.html.twig', [
            'controller_name' => 'accessController',
        ]);
    }

    #[Route('/plandusite', name: 'app_plan')]
    public function plan(): Response
    {
        return $this->render('legal/plan.html.twig', [
            'controller_name' => 'planController',
        ]);
    }

    #[Route('/guide', name: 'app_guide')]
    public function guide(): Response
    {
        return $this->render('legal/guide.html.twig', [
            'controller_name' => 'guideController',
        ]);
    }
}
