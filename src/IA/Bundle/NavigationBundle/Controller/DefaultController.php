<?php

namespace IA\Bundle\NavigationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * 
     * @param mixed $menu // Id or Alias
     * @return rendered menu html
     */
    public function renderAction($menuId)
    {
        return $this->render('IANavigationBundle:Default:navigation-main.html.twig');
    }
    
}
