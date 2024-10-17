<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;
use App\WsApogeeBundle\DependencyInjection\EtatIA;
use App\WsApogeeBundle\DependencyInjection\WsAdministratif;
use App\Entity\Account;
use App\Entity\People;
use L3\Bundle\LdapUserBundle\Entity\LdapUser;
use App\Form\AccountFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\AccountRepository;
use App\Repository\ActivityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Bridge\Google\Transport;
use Symfony\Component\Mime\Address;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpClient\HttpClient;

class AccountController extends AbstractController
{

    #[Route('/account', name: 'app_account')]
    public function index(
        AccountRepository $accountRepository,
        ManagerRegistry $doctrine,
        Request $request,
        MailerInterface $mailer,
    ): Response
    {
        $account = new Account();

        // $utilisateur = $this->getUser();

        $form = $this->createForm(AccountFormType::class, $account, [
            'action' => $this->generateUrl('app_account')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $em->persist($account);
            $em->flush();

            $this->addFlash('success', 'Votre compte a été créé !');

            return $this->redirectToRoute('app_profile_show');
        }

        return $this->render('account/index.html.twig', [
            'account_form' => $form->createView(),
            'account' => $account,
        ]);
    }


    #[Route('/delete/{id}', name: 'app_profile_delete')]
    public function delete(Account $account, EntityManagerInterface $entityManager): Response
    {
        // Check if the current user is the owner of the account
        $currentUser = $this->getUser();
        if ($currentUser !== $account) {
            throw $this->createAccessDeniedException('You are not allowed to delete this account.');
        }

        $this->container->get('security.token_storage')->setToken(null);

        // Delete the account
        $entityManager->remove($account);
        $entityManager->flush();

        // Optionally, you can add a success flash message
                
        $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !');

        // Redirect to a suitable route (e.g., homepage)
        return $this->redirectToRoute('homepage');

    }
}
