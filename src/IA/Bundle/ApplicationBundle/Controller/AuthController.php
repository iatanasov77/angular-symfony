<?php

namespace IA\Bundle\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthController extends Controller
{
    public function loginAction()
    {
        $tplVars = array();
        return $this->render('IAApplicationBundle:Auth:login.html.twig', $tplVars);
    }
}

