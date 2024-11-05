<?php

namespace App\Controller;

use App\Entity\Data;
use App\Form\DataFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class TraiterController extends AbstractController
{

    #[Route('/traiter', name: 'app_traiter')]
    public function index(
        Request $request,
        ManagerRegistry $doctrine,
        MailerInterface $mailer
    ): Response
    {
        $data = new data();
        $form = $this->createForm(DataFormType::class, $data, [
            'action' => $this->generateUrl('app_traiter'),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //function to add the account once create entity
            // $presentation->setAccount($this->getUser());
            

            $em = $doctrine->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'Votre data a été créé !');
            $toAddresses = ['lubna.akash@univ-montp3.fr'];
            $ccAddresses = ['lubna.altungi@gmail.com'];
            //mailer
            $email = (new Email())
                ->from('blast@univ-montp3.fr')
                ->to(...$toAddresses)
                ->cc(...$ccAddresses)
                ->subject('Formulaire de contact')
                ->text('Un message a été envoyé le ')
                ->html('<p>Un message a été envoyé le </p>');

                $mailer->send($email);

            return $this->redirectToRoute('app_traiter');
            
        }
        return $this->render('traiter/index.html.twig', [
            'data_form' => $form->createView(),
        ]);
    }
}