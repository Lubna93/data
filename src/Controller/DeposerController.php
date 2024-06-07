<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeposerController extends AbstractController
{
    #[Route('/deposer', name: 'app_deposer')]
    public function index(): Response
    {
        return $this->render('deposer/index.html.twig', [
            'controller_name' => 'DeposerController',
        ]);
    }
}
