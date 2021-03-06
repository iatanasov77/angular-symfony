<?php

namespace IA\Bundle\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;

use IA\Bundle\ServerBundle\Entity\Contact;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Get and decode post paarams
        $params = $this->get('request')->getContent();
        $params = json_decode($params);
        
        // Prepare Repository Params
        $searchArray = isset($params->search)   ? 
                        array($params->search->key => $params->search->val) :
                        array();
        $orderArray = array($params->orderBy=>$params->orderDir);
        $page = $params->page;
        $ipp = $params->ipp;

        // Query Repository
        $er = $this->getDoctrine()->getRepository('IAServerBundle:Contact');
        $entities = $er->findBy($searchArray, $orderArray, $ipp, ($page-1)*$ipp);
        $response = array(
                'countTotal' => $er->countTotal(),
                'entities' => $entities
            );

        // Serialize and return response
        $serializer = SerializerBuilder::create()->build();
        $response = $serializer->serialize($response, 'json');

        return new Response($response);
    }

    public function detailAction($id)
    {
        if(intval($id)) {
            $er = $this->getDoctrine()->getRepository('IAServerBundle:Contact');
            $contact = $er->find($id);
        } else {
            $contact = new Contact();
        }

        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($contact, 'json');

        return new Response($json);
    }

    public function saveAction()
    {
    	$data = $this->get("request")->getContent();

        $serializer = SerializerBuilder::create()->build();
        $contact = $serializer->deserialize($data, 'IA\Bundle\ServerBundle\Entity\Contact', 'json');
        $phones = $contact->getPhones();

        $entityManager = $this->getDoctrine()->getManager();
        $contact = $entityManager->merge($contact);
        
        /**
         * This not right but i don't know how to do
         */
        foreach($phones as $k => $phone) {
            $phone->setContact($contact);
            if(!$phone->getCreated()) {
                $phone->setCreated(new \DateTime());
                $phone->setModified(new \DateTime());
            }
            
            $entityManager->merge($phone);
        }
        $entityManager->flush();
        
        $response = array(
            'message' => 'SUCCESS!!!'
        );
        return new Response(json_encode($response));
    }

    public function deleteAction($id)
    {
        if(intval($id)) {
            $er = $this->getDoctrine()->getRepository('IAServerBundle:Contact');
            $contact = $er->find($id);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }
        
        $response = array(
            'message' => 'SUCCESS!!!'
        );
        return new Response(json_encode($response));
    }


}
