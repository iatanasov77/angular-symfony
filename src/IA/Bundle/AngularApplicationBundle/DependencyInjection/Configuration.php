<?php

namespace IA\Bundle\AngularApplicationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ia_angular_application');

        $rootNode
            ->children()
                ->arrayNode('routes')
                    ->defaultValue(array())
                    //->useAttributeAsKey('name')
                    ->prototype('array')
                    ->normalizeKeys(false)
                        ->children()
                            ->variableNode('name')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->variableNode('controller')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->variableNode('templateUrl')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->variableNode('isFree')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->variableNode('default')->end()     
            ->end();

        return $treeBuilder;
    }
}
