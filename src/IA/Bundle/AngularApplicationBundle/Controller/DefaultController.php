<?php

namespace IA\Bundle\AngularApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IAAngularApplicationBundle:Default:index.html.twig');
    }
}
