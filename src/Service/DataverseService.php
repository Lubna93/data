<?php

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
            // 'search?q=cnrs&type=dataset&subtree=cirad'
            'search?q=univ-ch&type=dataset&subtree=univ-ch'
        );

        return $response->toArray();
    }

    public function searchDatasets($query)
    {
        $response = $this->client->request(
            'GET',
            // 'search?q=' . urlencode($query) . '&type=dataset' . '&subtree=cirad'
            'search?q=' . urlencode($query) . '&type=dataset' . '&subtree=univ-ch'
        );

        return $response->toArray();
    }




public function searchDatasetsAdvanced(
    string $title = '', string $subtitle = '', string $alternativeURL = '', string $author = '', string $keywordValue = '', 
    string $kindOfData = '', string $seriesName= '', string $subject = '', string $language = '', string $dsDescriptionLanguage = '', string $producerName = '', string $producerAffiliation = '',
    string $distributorName = '', string $description = '', string $authorIdentifierScheme = '', 
    string $dataOrigin = '', string $lifeCycleStep = '', string $contributorName = '', 
    string $productionPlace = '', string $productionDate = '', string $distributionDate = '',
    string $dsPublicationDate = '', string $relatedDatasetIDType = ''
)
{
    $conditions = [];

    if ($title) {
        $conditions[] = "title:" . urlencode($title);
    }
    if ($subtitle) {
        $conditions[] = "subtitle:" . urlencode($subtitle);
    }
    if ($alternativeURL) {
        $conditions[] = "alternativeURL:" . urlencode($alternativeURL);
    }
    if ($author) {
        $conditions[] = "authorName:" . urlencode($author);
    }

    if ($keywordValue) {
        $conditions[] = "keywordValue_ss:%22" . urlencode($keywordValue) . "%22";
    }

    if ($kindOfData) {
        $conditions[] = "kindOfData:%22" . urlencode($kindOfData) . "%22";
    }
    if ($seriesName) {
        $conditions[] = "seriesName:%22" . urlencode($seriesName) . "%22";
    }
    
    if ($subject) {
        $conditions[] = "subject:%22" . urlencode($subject) . "%22";
    }
    if ($language) {
        $conditions[] = "language:%22" . urlencode($language) . "%22";
    } 
    if ($dsDescriptionLanguage) {
        $conditions[] = "dsDescriptionLanguage:%22" . urlencode($dsDescriptionLanguage) . "%22";
    } 
    if ($producerName) {
        $conditions[] = "producerName:%22" . urlencode($producerName) . "%22";
    } 
    if ($producerAffiliation) {
        $conditions[] = "producerAffiliation:%22" . urlencode($producerAffiliation) . "%22";
    }
    if ($distributorName) {
        $conditions[] = "distributorName:%22" . urlencode($distributorName) . "%22";
    }

    if ($description) {
        $conditions[] = "dsDescriptionValue:%22" . urlencode($description) . "%22";
    }

    if ($authorIdentifierScheme) {
        $conditions[] = "authorIdentifierScheme:%22" . urlencode($authorIdentifierScheme) . "%22";
    }

    if ($dataOrigin) {
        $conditions[] = "dataOrigin:%22" . urlencode($dataOrigin) . "%22";
    }

    if ($lifeCycleStep) {
        $conditions[] = "lifeCycleStep:%22" . urlencode($lifeCycleStep) . "%22";
    }

    if ($contributorName) {
        $conditions[] = "contributorName:%22" . urlencode($contributorName) . "%22";
    }

    if ($productionPlace) {
        $conditions[] = "productionPlace:%22" . urlencode($productionPlace) . "%22";
    }

    if ($productionDate) {
        $conditions[] = "productionDate:%22" . urlencode($productionDate) . "%22";
    }

    if ($distributionDate) {
        $conditions[] = "distributionDate:%22" . urlencode($distributionDate) . "%22";
    }

    if ($dsPublicationDate) {
        $conditions[] = "dsPublicationDate:%22" . urlencode($dsPublicationDate) . "%22";
    }

    if ($relatedDatasetIDType) {
        $conditions[] = "relatedDatasetIDType:%22" . urlencode($relatedDatasetIDType) . "%22";
    }

    $query = "search?q=" . implode(" AND ", $conditions);
    $response = $this->client->request('GET', $query . '&type=dataset&subtree=univ-ch');
    return $response->toArray();
}



}