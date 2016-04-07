<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use IA\Bundle\WebContentThiefBundle\Entity\Project;
use IA\Bundle\WebContentThiefBundle\Entity\ProjectField;

use IA\Bundle\WebContentThiefBundle\Form\ProjectType;

use IA\Bundle\WebContentThiefBundle\Utils\RemoteContent;
use Symfony\Component\DomCrawler\Crawler;

class ProjectsController extends Controller
{

    public function listProjectsAction()
    {
        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');

        $tplVars = array(
            'items' => $er->findAll(),
            'countProjects' => $er->countTotal()
        );
        return $this->render('IAWebContentThiefBundle:Projects:list.html.twig', $tplVars);
    }

    public function editProjectAction($id)
    {
        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');
        $oProject = $id ? $er->findOneBy(array('id' => $id)) : new Project();
        
        $request = $this->get('request');
        $form = $this->createForm(new ProjectType(), $oProject);
        if($oProject->getId()) {
            
            /*
             *  Fetch and populate First Details Page Link 
             */
            $remoteContent = new RemoteContent();
            $html = $remoteContent->browseUrl($oProject->getUrl());
            $crawler = new Crawler($html);
            $detailsLink = $crawler->filterXPath($oProject->getDetailsLink())->attr('href');
            $form->get('detailsPage')->setData($detailsLink);
        } else {
            $detailsLink = '';
        }
        
        
        //if($form->isSubmitted()) {
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isValid()) {
                // Валидацията гърми
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            
            return $this->redirect($this->generateUrl('ia_web_content_thief_list_projects'));
        }
        
        $tplVars = array(
            'form'          => $form->createView(),
            'item'          => $oProject,
            'detailsPageUrl'=> $detailsLink
        );
        return $this->render('IAWebContentThiefBundle:Projects:edit.html.twig', $tplVars);
    }

    public function deleteProjectAction($id)
    {
        $projectId = $this->_getParam("project");
        if ($oProject = Doctrine_Core::getTable('Model_ParserProject')->findOneBy('id', $projectId)) {
            $oProject->delete();
        }
        $this->_helper->redirector('list', 'index');
    }

    public function previewProjectAction($id)
    {
        $previewFields = array();
        $projectId = $this->_getParam("projectId");

        $oParser = new SvProject_Parser();
        $allAds = $oParser->run($projectId, TRUE);

        $this->view->assign('iProjectId', $projectId);
        $this->view->assign('allAds', $allAds[$projectId]);
    }

    public function runProjectAction($id)
    {
        $projectId = $this->_getParam("project");
        $previewFields = array();

        $oParser = new SvProject_Parser();
        try {
            $oParser->run($projectId);
        } catch (DontCatchException $e) {
            echo '<pre>';
            die(var_dump($e));
        }

        $this->_helper->redirector('list', 'index');
    }

    public function copyProjectAction($id)
    {
        $projectId = $this->_getParam("project");
        $oProject = Doctrine_Core::getTable('Model_ParserProject')->findOneBy('id', $projectId);

        $oProjectCopy = new Model_ParserProject();
        $oProjectCopy->url = $oProject->url . '_(COPY)';
        $oProjectCopy->user_id = $oProject->user_id;
        $oProjectCopy->category_id = $oProject->category_id;
        $oProjectCopy->project_title = $oProject->project_title . ' (COPY)';
        $oProjectCopy->active = $oProject->active;

        $aFields = $oProject->fields->toArray();
        $i = 0;
        foreach ($aFields as $f) {
            $oProjectCopy->fields[$i]['fields_caption'] = $f['fields_caption'];
            $oProjectCopy->fields[$i]['xquery'] = $f['xquery'];

            $i++;
        }

        $commonFieldsAds = array('title', 'description', 'price', 'region', 'city', 'zip');
        $aFieldsAds = $oProject->fieldsAds->toArray();
        $i = 0;
        foreach ($aFieldsAds as $f) {
            if (in_array($f['fields_caption'], $commonFieldsAds)) {
                $oProjectCopy->fieldsAds[$i]['fields_caption'] = $f['fields_caption'];
                $oProjectCopy->fieldsAds[$i]['xquery'] = $f['xquery'];
            }
            $i++;
        }


        //echo '<pre>'; die(var_dump($oProjectCopy->fields->toArray()));
        $oProjectCopy->save();
        $this->_helper->redirector('list', 'index');
    }

    public function browseAction()
    {
        $request = $this->get('request');
        $url = $request->query->get('url');
        $remoteContent = new RemoteContent();
        $html = $remoteContent->browseUrl(urldecode($url));
        
        return new Response($html);
    }
    
    function addFieldsAction()
    {
        $request = $this->get('request');
        $projectId = $request->request->get('projectId');
        $fieldsetId = $request->request->get('fieldsetId');
        
        $fr = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Fieldset');
        $oFieldset = $fieldsetId ? $fr->findOneBy(array('id' => $fieldsetId)) : null;
        if(!$oFieldset) {
            throw new \Exception('Fieldset not found!');
        }
        
        $pr = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');
        $oProject = $projectId ? $pr->findOneBy(array('id' => $projectId)) : null;
        if(!$oProject) {
            throw new \Exception('Project not found!');
        }
        
        foreach($oFieldset->getFields() as $field) {
            $projectField = new ProjectField();
            $projectField->setTitle($field->getTitle());
            $projectField->setType($field->getType());
            $projectField->setXquery('');
            $oProject->addField($projectField);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($oProject);
        $em->flush();

        return new Response();
    }

}
