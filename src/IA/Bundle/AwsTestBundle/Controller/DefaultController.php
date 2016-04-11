<?php

namespace IA\Bundle\AwsTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {   
        return $this->render('IAAwsTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
