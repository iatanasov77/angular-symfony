<?php

namespace IA\Bundle\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RoutesController extends Controller
{
    public function indexAction()
    {
        $result = array(
            "routes" => array(
                    array("name" => "/contacts", "templateUrl" => "/application/templates/contacts.html", "controller" => "ContactsController", "isFree" => true),
                    array("name" => "/add-contact", "templateUrl" => "/application/templates/editContact.html", "controller" => "ContactEditController", "isFree" => true),
                    array("name" => "/edit-contact/:contactId", "templateUrl" => "/application/templates/editContact.html", "controller" => "ContactEditController", "isFree" => true)
            ),
            "default" => "/contacts"
        );
        $response = json_encode($result);

        return new Response($response);
    }
}

