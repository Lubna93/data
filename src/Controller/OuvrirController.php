<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Science;
use Pagerfanta\Pagerfanta;
use App\Repository\Tag1Repository;
use App\Repository\ScienceRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\String\u;
use Pagerfanta\Doctrine\ORM\QueryAdapter;



class OuvrirController extends AbstractController
{
    // #[Route('/science', name: 'app_science')]
    // public function index(
    //     ScienceRepository $scienceRepository,
    //     Request $request,
    //     Tag1Repository $tag1Repository,
    //     ManagerRegistry $doctrine
    // ): Response
    // {
    //     $tags = $tag1Repository->findAll();

    //     $queryBuilder = $scienceRepository->findByNewestQueryBuilder(
    //         $request->query->get('science')
    //     );


    //     $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
    //     $pagerfanta->setMaxPerPage(12);
    //     $pagerfanta->setCurrentPage($request->query->get('page', 1));

    //     if ($request->query->get('preview')) {
    //         return $this->render('ouvrir/_searchPreview.html.twig', [
    //             'pager' => $pagerfanta,
    //         ]);
    //     }

    //     return $this->render('ouvrir/index.html.twig', [
    //         'controller_name' => 'Science',
    //         'pager' => $pagerfanta,
    //         'tags' => $tags
    //     ]);
    // }

    // #[Route('/science/{id}', name: 'science_show')]
    // public function show(
    //     Science $science,
    //     ScienceRepository $scienceRepository,
    //     Tag1Repository $tag1Repository,
    //     Request $request,
    //     ManagerRegistry $doctrine
    //     ): Response
    // {
    //     $tags = $tag1Repository->findAll();
    //     $sciences = $scienceRepository->findAll();
    //     return $this->render('ouvrir/show.html.twig', [
    //         'science' => $science,
    //         'sciences' => $sciences,
    //         'tags' => $tags
    //     ]);
    // }

    // #[Route('/science-tag/{slugtag}', name: 'science_tag')]
    //     public function tag(
    //         ScienceRepository $scienceRepository,
    //         Request $request,
    //         Tag1Repository $tag1Repository,
    //         string $slugtag = null): Response
    //     {
    //         $queryBuilder = $scienceRepository->findByNewestQueryBuilder(
    //             $request->query->get('science')
    //         );

    //         $tag1  = $tag1Repository->findOneBy(['id' => $slugtag]);
        
    //         $queryBuilder = $scienceRepository->createQueryBuilder('science')
    //             ->orderBy('science.createdat', 'DESC')
    //             ->where('science.published = TRUE'); 
        
    //             if ($tag1) {
    //                 $queryBuilder
    //                     ->andWhere(':tag1 MEMBER OF science.Tag1') // Use the MEMBER OF operator
    //                     ->setParameter('tag1', $tag1);
    //             }
        
    //         $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
    //         $pagerfanta->setMaxPerPage(12);
    //         $pagerfanta->setCurrentPage($request->query->get('page', 1));
    //         $tags = $tag1Repository->findAll();

    //         return $this->render('ouvrir/tag.html.twig', [
    //             'tags' => $tags,
    //             'tag1' => $tag1,
    //             'pager' => $pagerfanta, // Pass the Pagerfanta instance to the template
    //         ]);
    //     }


        
        #[Route('/realisations', name: 'science_realiser')]
    
        public function realiser(Request $request){

    
            return $this->render('ouvrir/realiser.html.twig', [

            ]);
        } 

        #[Route('/entrepot', name: 'entrepot')]
    
        public function entrepot(Request $request){

    
            return $this->render('ouvrir/entrepot.html.twig', [

            ]);
        } 

        #[Route('/ouvrir', name: 'ouvrir')]
    
        public function fluxrss(Request $request){
            // $rssFileNews = 'https://coop-ist.cirad.fr/RSS/actualites.rss';
            // $rssFileNews = 'https://www.datacc.org/feed/';           

            // $rss = simplexml_load_file($rssFileNews);
            // dump($rss);
    
            return $this->render('ouvrir/fluxrss.html.twig', [
                // 'rss' => $rss,
            ]);
        }

        #[Route('/veille1', name: 'actualites_rss1')]
    
        public function viewRSSAAction(Request $request){
            $rssFileNews = 'https://www.didaktic.fr/feed';

            $rssFileAgenda = 'https://www.univ-montp3.fr/fr/agenda/1/all/rss.xml';
            
            $rss = simplexml_load_file($rssFileNews);
    
            return $this->render('ouvrir/fluxrss1.html.twig', [
                'rss' => $rss,
            ]);
        }

        #[Route('/veille2', name: 'actualites_rss2')]
    
        public function fluxrss2(Request $request){
            $rssFileNews = 'https://coop-ist.cirad.fr/RSS/actualites.rss';       

            $rss = simplexml_load_file($rssFileNews);
            // dump($rss);
    
            return $this->render('ouvrir/fluxrss2.html.twig', [
                'rss' => $rss,
            ]);
        }

        #[Route('/veille3', name: 'actualites_rss3')]
    
        public function fluxrss3(Request $request){
            $rssFileNews = 'https://www.inserm.fr/feed/';       

            $rss = simplexml_load_file($rssFileNews);
            // dump($rss);
    
            return $this->render('ouvrir/fluxrss3.html.twig', [
                'rss' => $rss,
            ]);
        }

        #[Route('/veille4', name: 'actualites_rss4')]
    
        public function fluxrss4(Request $request){
            $rssFileNews = 'http://journals.openedition.org/revuehn/backend?format=rssdocuments';       

            $rss = simplexml_load_file($rssFileNews);
            dump($rss);
    
            return $this->render('ouvrir/fluxrss4.html.twig', [
                'rss' => $rss,
            ]);
        }

}
