<?php

namespace IA\Bundle\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IAApplicationBundle:Default:index.html.twig', array('name' => $name));
    }
}
