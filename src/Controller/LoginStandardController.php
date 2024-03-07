<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginStandardController extends AbstractController
{
    /**
     * @Route("/login/standard", name="app_login_standard")
     */
    public function index(Request $request): Response
    {

        return $this->render('login_standard/index.html.twig', [
            'controller_name' => 'LoginStandardController',
        ]);
    }
}
