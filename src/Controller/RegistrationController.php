<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="app_registration")
     */
    public function index(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set the ROLE_ADMIN for the user
            $user->setRole(['ROLE_ADMIN']);

            // Persist the user in the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to a success page or perform any other actions
            $this->addFlash('success', 'Inscription réussie !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form->createView(),
        ]);
    }
}
