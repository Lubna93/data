<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;
// use App\Service\DataverseService;

// class DataverseController extends AbstractController
// {
//     private $dataverseService;

//     public function __construct(DataverseService $dataverseService)
//     {
//         $this->dataverseService = $dataverseService;
//     }

//     #[Route('/datasets', name: 'datasets')]
//     public function showDatasets(): Response
//     {
//         $response = $this->dataverseService->getLastDatasets();

//         // Ensure you get the datasets from the response
//         $datasets = $response['data']['items'];

//         return $this->render('dataverse/datasets.html.twig', [
//             'datasets' => $datasets,
//         ]);
//     }
// }


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DataverseService;

class DataverseController extends AbstractController
{
    private $dataverseService;

    public function __construct(DataverseService $dataverseService)
    {
        $this->dataverseService = $dataverseService;
    }

    #[Route('/datasets', name: 'datasets')]
    public function showDatasets(): Response
    {
        $response = $this->dataverseService->getLastDatasets();

        // Ensure you get the datasets from the response
        $datasets = $response['data']['items'];

        return $this->render('dataverse/datasets.html.twig', [
            'datasets' => $datasets,
        ]);
    }

    #[Route('/search-datasets', name: 'search_datasets')]
    public function searchDatasets(Request $request): Response
    {
        $query = $request->query->get('query', 'cnrs'); // default to 'cnrs' if no query

        $response = $this->dataverseService->searchDatasets($query);

        // Ensure you get the datasets from the response
        $datasets = $response['data']['items'];

        return $this->render('dataverse/datasets.html.twig', [
            'datasets' => $datasets,
            'query' => $query,
        ]);
    }
}