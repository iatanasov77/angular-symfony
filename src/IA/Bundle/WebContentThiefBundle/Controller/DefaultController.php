<?php

namespace IA\Bundle\WebContentThiefBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IA\Bundle\WebContentThiefBundle\Entity\Project;

class DefaultController extends Controller
{

    public function listProjectsAction()
    {

        $er = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');


        $tplVars = array(
            'projects' => $er->findAll(),
            'countProjects' => $er->countTotal()
        );
        return $this->render('IAWebContentThiefBundle:Default:list-projects.html.twig', $tplVars);
    }

    public function editProjectAction($id)
    {
        $html = '';
        $url = '';
        $adsUrl = 0;


        /*
         * List with Charset Encodings
         */
        $charsetEncodings = array('UTF-8', 'CP1251');

        
        $pr = $this->getDoctrine()->getRepository('IAWebContentThiefBundle:Project');
        if ($id) {
            $oProject = $pr->findOneBy('id', $id);
            $url = $oProject->url;
        } else {
            $oProject = new Project();
        }
        
        $request = $this->get('request');
        if($request->isMethod('POST')) {

            $this->_initProject($oProject, $request->getContent());

            $formAction = $this->_getParam("formAction");

            /*
             * Save Project
             */
            if ($formAction == 'save') {
                try {
                    $oProject->save();
                } catch (DontCatchException $e) {
                    echo '<pre>';
                    die(var_dump($e));
                }
                /*
                  catch(Exception $e) {
                  //echo "<pre>"; die(var_dump($e));
                  }
                 */
            }

            /*
             * Address Bar URL is changed
             */ else if ($formAction == 'browse') {
                $url = $this->_getParam("addressBar");
                if (!empty($url)) {
                    if (stripos($url, 'http') === FALSE) {
                        $url = 'http://' . $url;
                    }

                    $pr = Doctrine_Core::getTable('Model_ParserProject')->findOneBy('url', $url);
                    if (is_object($pr)) {
                        $oProject = $pr;
                    } else {
                        $oProject->url = $url;
                    }
                }
            } else if ($formAction == 'ads_url_changed') {
                $adsUrl = $this->_getParam("ads_url");

                if ($adsUrl != '0') {
                    $url = $adsUrl;
                }
            }
        }

//        $catSql = Doctrine_Query::create()
//                ->from('Model_Category c')
//                ->leftJoin('c.Translation t')
//                ->leftJoin('c.Fieldset f')
//                ->leftJoin('c.Children ch')
//                ->where('t.lang_id = ?');
//        //->andWhere('c.parent_id=0');
//        //->orderBy('c.parent_id')
//
//
//        $categories = $catSql->execute(array('eng'));
//        //$categories = $catSql->execute(array('bulgarian'));
//        
//        $fieldsets = Doctrine_Core::getTable('Model_Fieldset')->findAll();


        /*
         * Init General Fields
         */
        $fields = array(
            array('caption' => 'add_link', 'Translation' => array(array('name' => 'Add Link'))),
            array('caption' => 'page_link', 'Translation' => array(array('name' => 'Page Link')))
        );


        /*
         * Init Ads Fields
         */
        if ($oProject->getCategoryid()) {


            $fieldSql = Doctrine_Query::create()
                    ->from('Model_Field f')
                    ->leftJoin('f.Translation t')
                    ->where("FIND_IN_SET({$oProject->getFieldsetId()} , f.fieldset)")
                    ->andWhere('t.lang_id = ?');
//die($fieldSql->getSqlQuery());
            $fieldsAds = $fieldSql->execute(array('eng'))
                    ->toArray();
        }

        $commonFieldsAds = array(
            array('caption' => 'title', 'Translation' => array(array('name' => 'Title'))),
            array('caption' => 'description', 'Translation' => array(array('name' => 'Description'))),
            array('caption' => 'price', 'Translation' => array(array('name' => 'Price'))),
            array('caption' => 'region', 'Translation' => array(array('name' => 'Region'))),
            array('caption' => 'city', 'Translation' => array(array('name' => 'City'))),
            array('caption' => 'zip', 'Translation' => array(array('name' => 'ZIP')))
        );

        $fieldsAds = empty($fieldsAds) ? $commonFieldsAds : array_merge($commonFieldsAds, $fieldsAds);

        /*
         * Init Picture Fields
         */
        $fieldsAdsPictures = array(
            array('caption' => 'pictures_1', 'Translation' => array(array('name' => 'Picture 1'))),
        );

        
        if (!empty($url)) {
            $html = $oProject->getUrlContent($url);
        }
//        $oEditor = new VS_TinyMce('tmceEdit');
//        $oEditor->setStylesheet('/css/browser.css');
//        $oEditor->setValue($html);
        
        $tplVars = array(
            'categoryId'        => $oProject->getCategoryid(),
            //'categories'        => $categories,
            'adsUrl'            => $adsUrl,
            'oProject'          => $oProject,
            'currentUrl'        => $url,
            //'oEditor'           => $oEditor,
            'html'              => $html,
            //'fieldsets'         => $fieldsets,
            'fields'            => $fields,
            'fieldsAds'         => $fieldsAds,
            'charsetEncodings'  => $charsetEncodings,
            'fieldsAdsPictures' => $fieldsAdsPictures,
            //'internalUrls'      => $oProject->getInternalUrls(),
            'internalUrls'      => array()
        );
        return $this->render('IAWebContentThiefBundle:Default:edit-project.html.twig', $tplVars);
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

    /**
     * Initialize Project Model
     * 
     * @param ParserProject $pr
     * @param array $params
     */
    protected function _initProject(&$pr, $params)
    {
        $pr->project_title = $params['projectName'];
        $pr->url = $params['addressBar'];

        //$pr->user = Doctrine_Core::getTable('Model_User')->findOneBy('id', Zend_Auth::getInstance()->getIdentity());
        //$pr->category = Doctrine_Core::getTable('Model_Category')->findOneBy('id', $params['category']);
        $pr->link('user', array(Zend_Auth::getInstance()->getIdentity()));
        $pr->link('category', array($params['category']));

        $pr->nopic = $params['nopic'];

        /*
         * Crop Picture Settings
         */
        $pr->picture_crop_top = $params['picture_crop_top'];
        $pr->picture_crop_right = $params['picture_crop_right'];
        $pr->picture_crop_bottom = $params['picture_crop_bottom'];
        $pr->picture_crop_left = $params['picture_crop_left'];

        $i = 0;
        foreach ($params['projectFields'] as $pKey => $pVal) {
            //$field = new Model_ParserProjectField();
            //$field->fields_caption = $pKey;
            //$field->xquery = $pVal;
            //$pr->fields[$i] = $field;
            $pr->fields[$i]['fields_caption'] = $pKey;
            $pr->fields[$i]['xquery'] = $pVal;

            $i++;
        }

        $i = 0;
        foreach ($params['projectFieldsAds'] as $pKey => $pVal) {
            $pr->fieldsAds[$i]['fields_caption'] = $pKey;
            $pr->fieldsAds[$i]['xquery'] = $pVal;

            $i++;
        }

        $i = 0;

        foreach ($params['projectFieldsAdsPictures'] as $pKey => $pVal) {
            if (empty($pVal['xquery']))
                continue;

            $pr->fieldsAdsPictures[$i]['xquery'] = $pVal['xquery'];

            $pr->fieldsAdsPictures[$i]['regex'] = get_magic_quotes_gpc() ? stripslashes($pVal['regex']) : $pVal['regex'];
            $pr->fieldsAdsPictures[$i]['replace'] = get_magic_quotes_gpc() ? stripslashes($pVal['replace']) : $pVal['replace'];

            $i++;
        }
    }

}
