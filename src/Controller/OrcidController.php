<?php

namespace App\Controller;

use App\Service\OrcidService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrcidController extends AbstractController
{

    #[Route('/connect/orcid', name: 'connect_orcid')]
    public function connect(OrcidService $orcidService): RedirectResponse
    {
        return new RedirectResponse($orcidService->getAuthorizationUrl());
    }

    #[Route('/connect/orcid/callback', name: 'connect_orcid_callback')]
    public function connectCallback(OrcidService $orcidService, Request $request): Response
    {
        $code = $request->query->get('code');

        if (!$code) {
            throw new \RuntimeException('No authorization code found');
        }

        // Exchange code for access token
        $token = $orcidService->getToken($code);

        // Store token or use it to fetch user data
        // Example: $accessToken = $token['access_token'];

        return $this->redirectToRoute('app_traiter');
    }
}

