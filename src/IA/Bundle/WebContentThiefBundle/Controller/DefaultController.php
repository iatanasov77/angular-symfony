<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        
//        
//        $projects = Doctrine_Core::getTable('Model_ParserProject')->findAll();
//    	if($this->_request->isPost()) {
//    		foreach($projects as $prj) {
//    			if(isset($_POST['active'][$prj->id])) {
//    				$prj->active = 1;
//    			}
//    			else {
//    				$prj->active = 0;
//    			}
//    		
//    			$prj->save();
//    		}
//    		
//    		$this->_helper->redirector('list', 'index');
//    	}
//    	
    	
        
        $tplVars = array(
            'projects' => $projects
        );
        return $this->render('IAWebContentThiefBundle:Default:index.html.twig',  $tplVars);
    }
}
