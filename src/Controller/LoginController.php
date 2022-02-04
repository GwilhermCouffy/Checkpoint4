<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    # Permet de rediriger selon le rôle de l'utilisateur
    #[Route('/choose-user-type', name: '_choice')]
    public function chooseUserType()
    {
        if ($this->isGranted("ROLE_ADMIN")) {
            return $this->redirectToRoute("beer_index");
        } elseif ($this->isGranted("ROLE_USER")) {
            return $this->redirectToRoute("beerCollection_index");
        }
    }
}
