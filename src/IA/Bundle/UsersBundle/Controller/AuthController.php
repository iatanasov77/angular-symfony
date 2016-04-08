<?php

namespace IA\Bundle\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthController extends Controller
{
    public function loginAction()
    {
        return $this->render('IAUsersBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function registerAction()
    {
        return $this->render('IAUsersBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function forgotPasswordAction()
    {
        return $this->render('IAUsersBundle:Default:index.html.twig', array('name' => $name));
    }
}
