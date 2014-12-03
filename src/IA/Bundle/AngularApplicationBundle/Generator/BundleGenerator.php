<?php

namespace IA\Bundle\AngularApplicationBundle\Generator;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;
use Sensio\Bundle\GeneratorBundle\Generator\Generator;

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
        $dir .= '/'.strtr($namespace, '\\', '/');
        if (file_exists($dir)) {
            if (!is_dir($dir)) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" exists but is a file.', realpath($dir)));
            }
            $files = scandir($dir);
            if ($files != array('.', '..')) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not empty.', realpath($dir)));
            }
            if (!is_writable($dir)) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not writable.', realpath($dir)));
            }
        }

        $basename = substr($bundle, 0, -6);
        $parameters = array(
            'namespace' => $namespace,
            'bundle'    => $bundle,
            'format'    => $format,
            'bundle_basename' => $basename,
            'extension_alias' => Container::underscore($basename),
        );

        $this->renderFile('bundle/Bundle.php.twig', $dir.'/'.$bundle.'.php', $parameters);
        //$this->renderFile('bundle/Extension.php.twig', $dir.'/DependencyInjection/'.$basename.'Extension.php', $parameters);
        $this->renderFile('bundle/Configuration.php.twig', $dir.'/DependencyInjection/Configuration.php', $parameters);
        $this->renderFile('bundle/DefaultController.php.twig', $dir.'/Controller/DefaultController.php', $parameters);
        $this->renderFile('bundle/DefaultControllerTest.php.twig', $dir.'/Tests/Controller/DefaultControllerTest.php', $parameters);
        $this->renderFile('bundle/index.html.twig.twig', $dir.'/Resources/views/Default/index.html.twig', $parameters);

        if ('xml' === $format || 'annotation' === $format) {
            $this->renderFile('bundle/services.xml.twig', $dir.'/Resources/config/services.xml', $parameters);
        } else {
            $this->renderFile('bundle/services.'.$format.'.twig', $dir.'/Resources/config/services.'.$format, $parameters);
        }

        if ('annotation' != $format) {
            $this->renderFile('bundle/routing.'.$format.'.twig', $dir.'/Resources/config/routing.'.$format, $parameters);
        }

        if ($structure) {
            $this->renderFile('bundle/messages.fr.xlf', $dir.'/Resources/translations/messages.fr.xlf', $parameters);

            $this->_filesystem->mkdir($dir.'/Resources/doc');
            $this->_filesystem->touch($dir.'/Resources/doc/index.rst');
            $this->_filesystem->mkdir($dir.'/Resources/translations');
            $this->_filesystem->mkdir($dir.'/Resources/public/css');
            $this->_filesystem->mkdir($dir.'/Resources/public/images');
            $this->_filesystem->mkdir($dir.'/Resources/public/js');
        }
        
        
        /*
         * My Files
         */
        $this->renderFile('angularbundle/Extension.php.twig', $dir.'/DependencyInjection/'.$basename.'Extension.php', $parameters);
        $this->renderFile('angularbundle/requirejs.yml.twig', $dir.'/Resources/config/requirejs.yml', $parameters);
        $this->renderFile('angularbundle/routing_angular.yml.twig', $dir.'/Resources/config/routing_angular.yml', $parameters);
        $this->renderFile('angularbundle/bower.json.twig', $dir.'/Resources/config/bower.json', $parameters);
    }
}

