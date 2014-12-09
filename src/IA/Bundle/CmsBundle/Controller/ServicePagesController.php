<?php
namespace IA\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;

use IA\Bundle\CmsBundle\Entity\Page;

class ServicePagesController extends Controller
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
        $orderArray = isset($params->orderBy) 
                            ? array($params->orderBy=>$params->orderDir)
                            : array();
        $orderArray = array();
        $page = isset($params->page) ? $params->page : 1;
        $ipp = isset($params->ipp) ? $params->ipp : 10;

        // Query Repository
        $er = $this->getDoctrine()->getRepository('IACmsBundle:Page');
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
            $er = $this->getDoctrine()->getRepository('IACmsBundle:Page');
            $page = $er->find($id);
        } else {
            $page = new Page();
        }

        $serializer = SerializerBuilder::create()->build();
        $json = $serializer->serialize($page, 'json');

        return new Response($json);
    }

    public function saveAction()
    {
    	$data = $this->get("request")->getContent();
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $serializer = SerializerBuilder::create()->build();
        $page = $serializer->deserialize($data, 'IA\Bundle\CmsBundle\Entity\Page', 'json');
        $page->setLocale('bg');
        $entityManager->persist($page);
        $entityManager->flush();
        
        $response = array(
            'message' => 'SUCCESS!!!'
        );
        return new Response(json_encode($response));
    }

    public function deleteAction($id)
    {
        if(intval($id)) {
            $er = $this->getDoctrine()->getRepository('IACmsBundle:Pages');
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
