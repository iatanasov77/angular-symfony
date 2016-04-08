<?php

namespace IA\Bundle\ApplicationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IAApplicationBundle extends Bundle
{
    public function boot()
    {
        //$user = $this->container->get('security.context')->getToken()->getUser();
        //var_dump($user); die;
        //$this->container->get('twig')->addGlobal('user', $user);
    }
}
