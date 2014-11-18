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
                    array("name" => "/contacts", "templateUrl" => "/bundles/iaangularapplication/application/templates/contacts.html", "controller" => "ContactsController", "isFree" => true),
                    array("name" => "/add-contact", "templateUrl" => "/bundles/iaangularapplication/application/templates/editContact.html", "controller" => "ContactEditController", "isFree" => true),
                    array("name" => "/edit-contact/:contactId", "templateUrl" => "/bundles/iaangularapplication/application/templates/editContact.html", "controller" => "ContactEditController", "isFree" => true),
                
                    array("name" => "/pages", "templateUrl" => "/bundles/iacms/js/templates/pages.html", "controller" => "PagesController", "isFree" => true),
                    array("name" => "/add-page", "templateUrl" => "/bundles/iacms/js/templates/editPage.html", "controller" => "PageEditController", "isFree" => true),
            ),
            "default" => "/contacts"
        );
        $response = json_encode($result);

        return new Response($response);
    }
}

