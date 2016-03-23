<?php

namespace IA\Bundle\UsersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IAUsersBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
