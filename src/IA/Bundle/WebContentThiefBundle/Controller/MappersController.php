<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use IA\Bundle\WebContentThiefBundle\Entity\Project;
use IA\Bundle\WebContentThiefBundle\Entity\ProjectField;

use IA\Bundle\WebContentThiefBundle\Form\ProjectType;

use IA\Bundle\WebContentThiefBundle\Utils\RemoteContent;

class MappersController extends Controller
{

    public function listAction()
    {
        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');


        $tplVars = array(
            'items' => $er->findAll(),
            'countProjects' => $er->countTotal()
        );
        return $this->render('IAWebContentThiefBundle:Projects:list.html.twig', $tplVars);
    }

    public function editAction($id) 
    {
        
    }
    
}
