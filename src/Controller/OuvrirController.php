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
    #[Route('/science', name: 'app_science')]
    public function index(
        ScienceRepository $scienceRepository,
        Request $request,
        Tag1Repository $tag1Repository,
        ManagerRegistry $doctrine
    ): Response
    {
        $tags = $tag1Repository->findAll();

        $queryBuilder = $scienceRepository->findByNewestQueryBuilder(
            $request->query->get('science')
        );


        $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage(12);
        $pagerfanta->setCurrentPage($request->query->get('page', 1));

        return $this->render('science/index.html.twig', [
            'controller_name' => 'Science',
            'pager' => $pagerfanta,
            'tags' => $tags
        ]);
    }

    #[Route('/science/{id}', name: 'science_show')]
    public function show(
        Science $science,
        ScienceRepository $scienceRepository,
        Tag1Repository $tag1Repository,
        Request $request,
        ManagerRegistry $doctrine
        ): Response
    {
        $tags = $tag1Repository->findAll();
        $sciences = $scienceRepository->findAll();
        return $this->render('science/show.html.twig', [
            'science' => $science,
            'sciences' => $sciences,
            'tags' => $tags
        ]);
    }

    #[Route('/science-tag/{slugtag}', name: 'science_tag')]
        public function tag(
            ScienceRepository $scienceRepository,
            Request $request,
            Tag1Repository $tag1Repository,
            string $slugtag = null): Response
        {
            $queryBuilder = $scienceRepository->findByNewestQueryBuilder(
                $request->query->get('science')
            );

            $tag1  = $tag1Repository->findOneBy(['id' => $slugtag]);
        
            $queryBuilder = $scienceRepository->createQueryBuilder('science')
                ->orderBy('science.createdat', 'DESC')
                ->where('science.published = TRUE'); 
        
                if ($tag1) {
                    $queryBuilder
                        ->andWhere(':tag1 MEMBER OF science.Tag1') // Use the MEMBER OF operator
                        ->setParameter('tag1', $tag1);
                }
        
            $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
            $pagerfanta->setMaxPerPage(12);
            $pagerfanta->setCurrentPage($request->query->get('page', 1));
            $tags = $tag1Repository->findAll();

            return $this->render('science/tag.html.twig', [
                'tags' => $tags,
                'tag1' => $tag1,
                'pager' => $pagerfanta, // Pass the Pagerfanta instance to the template
            ]);
        }

}
