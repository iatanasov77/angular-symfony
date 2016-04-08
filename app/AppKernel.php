<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            /*
             * Symfony Bundles
             */
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            //new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            
            /*
             * Doctrine Bundles
             */
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            
            /*
             * Other Vendor Bundles
             */
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppVentus\AsseticInjectorBundle\AvAsseticInjectorBundle(),
            //new Hearsay\RequireJSBundle\HearsayRequireJSBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            
            
            /*
             * IA Bundles
             */
            //new IA\Bundle\AngularApplicationBundle\IAAngularApplicationBundle(),
            //new IA\Bundle\ServerBundle\IAServerBundle(),
            //new IA\Bundle\CmsBundle\IACmsBundle(),
            //new IA\Bundle\NavigationBundle\IANavigationBundle(),
            //new IA\Bundle\AngularAdminPanelBundle\IAAngularAdminPanelBundle(),
            
            //new IA\Bundle\MultiLanguageBundle\IAMultiLanguageBundle(),
            //new ServerGrove\Bundle\TranslationEditorBundle\ServerGroveTranslationEditorBundle(),
            new IA\Bundle\UsersBundle\IAUsersBundle(),
            
            new IA\Bundle\WebContentThiefBundle\IAWebContentThiefBundle(),
            new IA\Bundle\ApplicationBundle\IAApplicationBundle(),
            new IA\Bundle\DoctrineBundle\IADoctrineBundle(),
            
            
            /*
             * AWS Research
             */
            new AmazonWebServicesBundle\ThePhalconsAmazonWebServicesBundle(),
            new IA\Bundle\AwsTestBundle\IAAwsTestBundle(),
            
            
            
            
        );

        /*
         * Developement Tools
         */
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Sp\BowerBundle\SpBowerBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
