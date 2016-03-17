<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');
        	
        
        $tplVars = array(
            'projects'      => $er->findAll(),
            'countProjects' => $er->countTotal()
        );
        return $this->render('IAWebContentThiefBundle:Default:index.html.twig',  $tplVars);
    }
}
