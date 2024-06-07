<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
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
}
