<?php

namespace IA\Bundle\ApplicationBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

use Knp\Menu\Matcher\Voter\RouteVoter;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        //Projects
        $menu->addChild('Projects', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_document_alt')));
        $menu['Projects']->addChild('List Projects', array('route' => 'ia_web_content_thief_list_projects'));
        $menu['Projects']->addChild('Create New Project', array(
            'route' => 'ia_web_content_thief_edit_project',
            'routeParameters' => array('id' => 0)
        ));

        // Fieldsets
        $menu->addChild('Fieldsets', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_table')));
        $menu['Fieldsets']->addChild('List Fieldsets', array('route' => 'ia_web_content_thief_fieldsets_list'));
        $menu['Fieldsets']->addChild('Create New Fieldset', array(
            'route' => 'ia_web_content_thief_fieldsets_edit',
            'routeParameters' => array('id' => 0)
        ));
        
        // Mappers
        $menu->addChild('Mappers', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_documents_alt')));
        $menu['Mappers']->addChild('List Mappers', array('route' => 'ia_web_content_thief_mappers_list'));
        $menu['Mappers']->addChild('Create New Mapper', array(
            'route' => 'ia_web_content_thief_mappers_edit',
            'routeParameters' => array('id' => 0)
        ));
        
        // Connections
        $menu->addChild('Connections', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_genius')));
        $menu['Connections']->addChild('List Connections', array('route' => 'ia_web_content_thief_connections_list'));
        $menu['Connections']->addChild('Create New Connection', array(
            'route' => 'ia_web_content_thief_connections_edit',
            'routeParameters' => array('id' => 0)
        ));

        return $menu;
    }
    
    public function profileMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->addChild('My Profile', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_profile')));
        $menu->addChild('Log Out', array('route' => 'logout', 'attributes' => array('iconClass' => 'icon_key_alt')));
        $menu->addChild('Documentation', array('uri' => 'javascript:;', 'attributes' => array('iconClass' => 'icon_key_alt')));
        
        return $menu;
    }

    public function breadcrumbsMenu(FactoryInterface $factory, array $options)
    {
        $bcmenu = $this->mainMenu($factory, $options);
        return $this->getCurrentMenuItem($bcmenu) ?: $factory->createItem('Edit');
    }

    public function getCurrentMenuItem($menu)
    {
        $voter = new RouteVoter($this->container->get('request'));

        foreach ($menu as $item) {
            if ($voter->matchItem($item)) {
                return $item;
            }

            if ($item->getChildren() && $currentChild = $this->getCurrentMenuItem($item)) {
                return $currentChild;
            }
        }

        return null;
    }

}
