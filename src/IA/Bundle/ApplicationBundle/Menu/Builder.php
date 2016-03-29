<?php

namespace IA\Bundle\ApplicationBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        //$menu->addChild('Home', array('route' => 'homepage'));

        

        $menu->addChild('Projects', array('uri' => 'javascript:;'));
        $menu['Projects']->addChild('List Projects', array('route' => 'ia_web_content_thief_list_projects'));
        $menu['Projects']->addChild('Create New Project', array(
            'route' => 'ia_web_content_thief_edit_project',
            'routeParameters' => array('id' => 0)
        ));

        
        $menu->addChild('Fieldsets', array('uri' => 'javascript:;'));
        $menu['Fieldsets']->addChild('List Fieldsets', array('route' => 'ia_web_content_thief_fieldsets_list'));
        $menu['Fieldsets']->addChild('Create New Fieldset', array(
            'route' => 'ia_web_content_thief_fieldsets_edit',
            'routeParameters' => array('id' => 0)
        ));
        $menu->setAttribute('class', 'sidebar-menu');
        $menu->setChildrenAttribute('class', 'sidebar-menu');

        return $menu;
    }
}
