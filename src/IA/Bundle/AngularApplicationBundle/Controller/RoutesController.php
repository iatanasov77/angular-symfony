<?php

namespace IA\Bundle\AngularApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoutesController extends Controller
{
    public function indexAction()
    {
        $routes = $this->container->getParameter('ia_angular_application.routing_angular');
        return new JsonResponse($routes);
    }
}

