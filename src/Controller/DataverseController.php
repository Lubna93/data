<?php

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
        $query = $request->query->get('query', 'univ-ch'); 

        $response = $this->dataverseService->searchDatasets($query);

        // Ensure you get the datasets from the response
        $datasets = $response['data']['items'];

        return $this->render('dataverse/datasets.html.twig', [
            'datasets' => $datasets,
            'query' => $query,
        ]);
    }




#[Route('/advanced-search', name: 'advanced_search')]
public function advancedSearch(Request $request, DataverseService $dataverseService): Response
{
    $title = $request->query->get('title', '');
    $subtitle = $request->query->get('subtitle', '');
    $author = $request->query->get('authorName', '');
    $keywordValue = $request->query->get('keywordValue', '');
    $kindOfData = $request->query->get('kindOfData', '');
    $seriesName = $request->query->get('seriesName', '');
    $subject = $request->query->get('subject', '');
    $producerName = $request->query->get('producerName', '');
    $producerAffiliation = $request->query->get('producerAffiliation', '');
    $distributorName = $request->query->get('distributorName', '');
    $description = $request->query->get('description', '');
    $authorIdentifierScheme = $request->query->get('authorIdentifierScheme', '');
    $dataOrigin = $request->query->get('dataOrigin', '');
    $lifeCycleStep = $request->query->get('lifeCycleStep', '');
    $dsDescriptionLanguage = $request->query->get('dsDescriptionLanguage', '');
    $language = $request->query->get('language', '');
    $contributorName = $request->query->get('contributorName', '');
    $productionPlace = $request->query->get('productionPlace', '');
    $productionDate = $request->query->get('productionDate', '');
    $distributionDate = $request->query->get('distributionDate', '');
    $dsPublicationDate = $request->query->get('dsPublicationDate', '');
    $relatedDatasetIDType = $request->query->get('relatedDatasetIDType', ''); // Updated to handle a single value

    $response = $dataverseService->searchDatasetsAdvanced(
        $title, $subtitle, $author, $keywordValue, $kindOfData, $seriesName, $subject, 
        $producerName, $producerAffiliation, $distributorName, $description, 
        $authorIdentifierScheme, $dataOrigin, $lifeCycleStep, $dsDescriptionLanguage, $language,
        $contributorName, $productionPlace, $productionDate, 
        $distributionDate, $dsPublicationDate, $relatedDatasetIDType
    );

    $datasets = $response['data']['items'] ?? [];

    return $this->render('dataverse/advanced_search.html.twig', [
        'datasets' => $datasets,
        'search_params' => compact(
            'title', 'subtitle', 'author', 'keywordValue', 'kindOfData', 'seriesName', 'subject', 
            'producerName', 'producerAffiliation', 'distributorName', 'description', 
            'authorIdentifierScheme', 'dataOrigin', 'lifeCycleStep', 'dsDescriptionLanguage', 'language',
            'contributorName', 'productionPlace', 'productionDate', 
            'distributionDate', 'dsPublicationDate', 'relatedDatasetIDType'
        ),
    ]);
}


#[Route('/results-search', name: 'results_search')]
public function resultsSearch(Request $request, DataverseService $dataverseService): Response
{
    $title = $request->query->get('title', '');
    $subtitle = $request->query->get('subtitle', '');
    $alternativeURL = $request->query->get('alternativeURL', '');
    $author = $request->query->get('authorName', '');
    $keywordValue = $request->query->get('keywordValue', '');
    $kindOfData = $request->query->get('kindOfData', '');
    $seriesName = $request->query->get('seriesName', '');
    $subject = $request->query->get('subject', '');
    $producerName = $request->query->get('producerName', '');
    $producerAffiliation = $request->query->get('producerAffiliation', '');
    $distributorName = $request->query->get('distributorName', '');
    $description = $request->query->get('description', '');
    $authorIdentifierScheme = $request->query->get('authorIdentifierScheme', '');
    $dataOrigin = $request->query->get('dataOrigin', '');
    $lifeCycleStep = $request->query->get('lifeCycleStep', '');
    $dsDescriptionLanguage = $request->query->get('dsDescriptionLanguage', '');
    $language = $request->query->get('language', '');
    $contributorName = $request->query->get('contributorName', '');
    $productionPlace = $request->query->get('productionPlace', '');
    $productionDate = $request->query->get('productionDate', '');
    $distributionDate = $request->query->get('distributionDate', '');
    $dsPublicationDate = $request->query->get('dsPublicationDate', '');
    $relatedDatasetIDType = $request->query->get('relatedDatasetIDType', ''); // Updated to handle a single value

    $response = $dataverseService->searchDatasetsAdvanced(
        $title, $subtitle, $author, $alternativeURL, $keywordValue, $kindOfData, $seriesName, $subject, 
        $producerName, $producerAffiliation, $distributorName, $description, 
        $authorIdentifierScheme, $dataOrigin, $lifeCycleStep, $dsDescriptionLanguage, $language,
        $contributorName, $productionPlace, $productionDate, 
        $distributionDate, $dsPublicationDate, $relatedDatasetIDType
    );

    $datasets = $response['data']['items'] ?? [];

    return $this->render('dataverse/results_search.html.twig', [
        'datasets' => $datasets,
        'search_params' => compact(
            'title', 'subtitle', 'alternativeURL', 'author', 'keywordValue', 'kindOfData', 'seriesName', 'subject', 
            'producerName', 'producerAffiliation', 'distributorName', 'description', 
            'authorIdentifierScheme', 'dataOrigin', 'lifeCycleStep', 'dsDescriptionLanguage', 'language',
            'contributorName', 'productionPlace', 'productionDate', 
            'distributionDate', 'dsPublicationDate', 'relatedDatasetIDType'
        ),
    ]);
}







}