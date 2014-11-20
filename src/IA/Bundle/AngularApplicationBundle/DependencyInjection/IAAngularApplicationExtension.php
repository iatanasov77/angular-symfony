<?php

namespace IA\Bundle\AngularApplicationBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;


/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class IAAngularApplicationExtension extends Extension implements PrependExtensionInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // Configuration
        $configuration = new Configuration();
        $config = $this->processConfiguration( $configuration, $configs );
        
        /*
         * Load Service and parameters
         */
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');
        // determine if AcmeGoodbyeBundle is registered
        if (!isset($bundles['HearsayRequireJSBundle'])) {
            throw new Exception('IAAngularApplicationBundle require HearsayRequireJSBundle.');
            
        }
        
        $config = array(
            'require_js_src' => '/bundles/iaangularapplication/vendor/requirejs',
            'base_url'       => 'js',
            'base_dir'       => '/',
            'paths'          => array(),
            'shim'           => array()
        );
        
        $container->prependExtensionConfig('hearsay_require_js', $config);
        
        
        /*
         * Load Angular Routes
         */
        $config = array('routing_angular' => Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/routing_angular.yml')));
        $container->prependExtensionConfig( 'ia_angular_application', $config);
    }
    
}
