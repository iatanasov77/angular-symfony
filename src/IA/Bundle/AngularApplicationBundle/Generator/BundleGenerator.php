<?php

namespace IA\Bundle\AngularApplicationBundle\Generator;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;
use Sensio\Bundle\GeneratorBundle\Generator\Generator;
use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator as SensioBundleGenerator;

/**
 * Generates a bundle.
 *
 * @author Ivan I. Atanasov <iatanasov77@gmail.com>
 */
class BundleGenerator extends Generator
{
    private $_filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->_filesystem = $filesystem;
    }

    public function generate($namespace, $bundle, $dir, $format, $structure)
    {
        $sensioGenerator = new SensioBundleGenerator($this->_filesystem);
        //$sensioGenerator->generate($namespace, $bundle, $dir, $format, $structure);
        
        /*
         *  Here is my code for generation
         */
        $dir .= '/'.strtr($namespace, '\\', '/');
        $basename = substr($bundle, 0, -6);
        $parameters = array(
            'namespace' => $namespace,
            'bundle'    => $bundle,
            'format'    => $format,
            'bundle_basename' => $basename,
            'extension_alias' => Container::underscore($basename),
        );
        
        $this->renderFile('bundle/Extension.php.twig', $dir.'/DependencyInjection/'.$basename.'Extension.php', $parameters);
        $this->renderFile('bundle/requirejs.yml.twig', $dir.'/Resources/config/requirejs.yml', $parameters);
        $this->renderFile('bundle/routing_angular.yml.twig', $dir.'/Resources/config/routing_angular.yml', $parameters);
        $this->renderFile('bundle/bower.json.twig', $dir.'/Resources/config/bower.json', $parameters);
    }
}

