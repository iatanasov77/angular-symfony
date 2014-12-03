<?php

namespace IA\Bundle\AngularApplicationBundle\Command;

use IA\Bundle\AngularApplicationBundle\Generator\BundleGenerator;
use Sensio\Bundle\GeneratorBundle\Command\GenerateBundleCommand as SensioGenerateBundleCommand;

/**
 * Generates Angular Application bundles.
 *
 * @author Ivan I. Atanasov <iatanasov77@gmail.com>
 */
class GenerateBundleCommand extends SensioGenerateBundleCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('ia:generate:angularbundle');
    }

    protected function createGenerator()
    {
        return new BundleGenerator($this->getContainer()->get('filesystem'));
    }
    
    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = parent::getSkeletonDirs($bundle);
        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';
        return $skeletonDirs;
    }
}
