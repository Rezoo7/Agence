<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $au
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $au)
    {
        $lastusername = $au->getLastUsername();
        $error = $au->getLastAuthenticationError();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastusername,
            'error' => $error
        ]);
    }
}
