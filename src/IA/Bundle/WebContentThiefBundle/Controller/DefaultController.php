<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IAWebContentThiefBundle:Default:index.html.twig', array('name' => $name));
    }
}
