<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AccountFormType;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/show', name: 'app_profile_show')]
    public function show(): Response
    {
        return $this->render('profile/show.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/delete', name: 'app_delete')]
    public function deleteconfirmation(): Response
    {
        return $this->render('profile/delete.html.twig', [
            
        ]);
    }


    #[Route('/edit/{id}', name: 'app_profile_edit')]
    public function edit(
        ManagerRegistry $doctrine,
        Request $request,
        Account $account,
    ): Response {
        // Check if the current user is the owner of the account
        $currentUser = $this->getUser();
        if ($currentUser !== $account) {
            throw $this->createAccessDeniedException('You are not the owner of this account.');
        }
    
        $form = $this->createForm(AccountFormType::class, $account);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
   
            $em = $doctrine->getManager();
            $em->persist($account);
            $em->flush();
    
            return $this->redirectToRoute('app_profile_show');
        }
    
        return $this->render('profile/edit.html.twig', [
            'edit_form' => $form->createView(),
        ]);
    }
}
