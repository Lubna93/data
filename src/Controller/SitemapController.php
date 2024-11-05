<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function index(
        Request $request
    ): Response {
        $hostname = $request->getSchemeAndHttpHost();
    
        $urls = [];
    
        // Add static routes
        $urls[] = ['loc' => $this->generateUrl('homepage')];
        $urls[] = ['loc' => $this->generateUrl('app_apropos')];
        $urls[] = ['loc' => $this->generateUrl('science_realiser')];
        $urls[] = ['loc' => $this->generateUrl('entrepot')];
        $urls[] = ['loc' => $this->generateUrl('actualites_rss')];
        $urls[] = ['loc' => $this->generateUrl('app_legal')];
        $urls[] = ['loc' => $this->generateUrl('app_guide')];
        $urls[] = ['loc' => $this->generateUrl('app_plan')];
        $urls[] = ['loc' => $this->generateUrl('app_access')];
    
        // Create XML document
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
    
        // Append URLs to the XML document
        foreach ($urls as $url) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', htmlspecialchars($hostname . $url['loc']));

        }
    
        // Generate response
        $response = new Response($xml->asXML());
        $response->headers->set('Content-Type', 'application/xml');
    
        return $response;
    }
}
