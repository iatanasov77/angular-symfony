<?php

namespace IA\Bundle\AngularAdminPanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IAAngularAdminPanelBundle:Default:index.html.twig');
    }
}
