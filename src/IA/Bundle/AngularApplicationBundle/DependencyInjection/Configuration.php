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
                ->arrayNode( 'routing_angular')
                    ->normalizeKeys(false)
                    ->prototype('array')
                        ->children()
                            ->variableNode('routes')
                
                                //->defaultValue(array())
                                //->useAttributeAsKey('name')
                                //->prototype('array')
                                //->normalizeKeys(false)
                                //    ->children()
                                //    ->end()
                                //->end()
                
                            ->end()
                            ->scalarNode('default')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode( 'requirejs')
                    ->defaultValue(array())
                    ->prototype('array')
                        ->children()
                            ->arrayNode( 'paths')
                                ->defaultValue(array())
                                ->prototype('array')
                                ->normalizeKeys(false)
                                ->end()
                            ->end()
                            ->arrayNode( 'shim')
                                ->defaultValue(array())
                                ->prototype('array')
                                ->normalizeKeys(false)
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
