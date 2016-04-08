<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use IA\Bundle\WebContentThiefBundle\Entity\Project;
use IA\Bundle\WebContentThiefBundle\Utils\ProjectParser;

class ParserController extends Controller
{
    public function runAction($projectId)
    {
        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');
        $oProject = $er->findOneBy(array('id' => $projectId));
        if(!$oProject) {
            throw new \Exception("Invalid Request!");
        }
        
        $parser = new ProjectParser($oProject);
        $parserItems = $parser->parse();
        
        var_dump($parserItems); die;
        
        return new Response();
    }
}
