<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;
use App\Form\AccountFormType;
use App\Repository\AccountRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;


class AccountController extends AbstractController
{

    #[Route('/account', name: 'app_account')]
    public function index(
        AccountRepository $accountRepository,
        ManagerRegistry $doctrine,
        Request $request,
        MailerInterface $mailer
    ): Response
    {
        $account = new Account();

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



    #[Route('/email', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from('blast@univ-montp3.fr')
            ->to('lubna.akash@univ-montp3.fr', 'lubna.altungi@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        // return $this->redirectToRoute('homepage');
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
