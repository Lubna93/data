<?php

namespace App\Service;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\RequestStack;

class OrcidService
{
    private $client;
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->client = new Client();
    }

    public function getAuthorizationUrl(): string
    {
        // Generate the authorization URL
        $baseUri = 'https://orcid.org/oauth/authorize';
        $queryParams = [
            'client_id' => 'APP-COWCB05BE2SBGHJ3',
            'response_type' => 'code',
            'scope' => '/authenticate',
            'redirect_uri' => 'http://127.0.0.1:8000',
            'redirect_uri' => 'http://127.0.0.1:8000',
            //'redirect_uri' => 'https://www.ch.b114.fr',
        ];
        $url = $baseUri . '?' . http_build_query($queryParams);

        return $url;
    }

    public function getToken(string $code): array
    {
        // Exchange authorization code for access token
        $tokenUri = 'https://orcid.org/oauth/token';
        $params = [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'APP-COWCB05BE2SBGHJ3',
                'client_secret' => '07aafe65-88a1-4832-b08c-8cd762d93e92',
                'redirect_uri' => 'http://127.0.0.1:8000',
                //'redirect_uri' => 'https://www.ch.b114.fr',
                'code' => $code,
            ],
        ];

        $response = $this->client->post($tokenUri, $params);
        return json_decode((string) $response->getBody(), true);
    }

    // Add methods to interact with ORCID API using obtained token
}
