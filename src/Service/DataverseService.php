<?php
// namespace App\Service;

// use Symfony\Contracts\HttpClient\HttpClientInterface;

// class DataverseService
// {
//     private $client;

//     public function __construct(HttpClientInterface $client)
//     {
//         $this->client = $client;
//     }

//     public function getDataset($datasetId)
//     {
//         $response = $this->client->request(
//             'GET',
//             'datasets/' . $datasetId
//         );

//         return $response->toArray();
//     }

//     public function getLastDatasets()
//     {
//         $response = $this->client->request(
//             'GET',
//             'search?q=cnrs&type=dataset'
//         );

//         return $response->toArray();
//     }
// }

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class DataverseService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getDataset($datasetId)
    {
        $response = $this->client->request(
            'GET',
            'datasets/' . $datasetId
        );

        return $response->toArray();
    }

    public function getLastDatasets()
    {
        $response = $this->client->request(
            'GET',
            'search?q=cnrs&type=dataset'
        );

        return $response->toArray();
    }

    public function searchDatasets($query)
    {
        $response = $this->client->request(
            'GET',
            'search?q=' . urlencode($query) . '&type=dataset'
        );

        return $response->toArray();
    }
}