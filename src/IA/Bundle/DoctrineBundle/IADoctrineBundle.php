<?php

namespace IA\Bundle\DoctrineBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use IA\Bundle\DoctrineBundle\DependencyInjection\CompilerPass\ConnectionCompilerPass;

class IADoctrineBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ConnectionCompilerPass());
    }

}
