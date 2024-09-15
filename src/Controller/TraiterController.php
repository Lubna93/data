<?php

namespace App\Controller;

use App\Entity\Data;
use App\Form\DataFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class TraiterController extends AbstractController
{
    #[Route('/traiter', name: 'app_traiter')]
    public function index(
        Request $request,
        ManagerRegistry $doctrine,
    ): Response
    {
        $data = new data();
        $form = $this->createForm(DataFormType::class, $data, [
            'action' => $this->generateUrl('app_traiter')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //function to add the account once create entity
            // $presentation->setAccount($this->getUser());
            

            $em = $doctrine->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'Votre data a été créé !');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('traiter/index.html.twig', [
            'data_form' => $form->createView(),
        ]);
    }
}