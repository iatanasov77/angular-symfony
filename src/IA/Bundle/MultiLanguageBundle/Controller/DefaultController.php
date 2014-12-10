<?php

namespace IA\Bundle\MultiLanguageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IAMultiLanguageBundle:Default:index.html.twig', array('name' => $name));
    }
}
