<?php

namespace IA\Bundle\WebContentThiefBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectsRepository extends EntityRepository
{

    public function countTotal()
    {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(p) FROM IAWebContentThiefBundle:Project p');

        return $query->getSingleScalarResult();
    }

    /**
     * Alias of getFieldValue($fieldName)
     */
    function getFieldXquery($fieldName, $NS, $entity)
    {
        return $this->getFieldValue($fieldName, $NS, $entity);
    }

    /**
     * Get Additional Fields
     */
    function getFieldAdsXqueryAdd($fieldName, $entity)
    {
        $fields = array();
        foreach ($entity->fieldsAds->toArray() as $f) {
            if (strpos($f['fields_caption'], $fieldName . '_') === 0) {
                $fields[$f['fields_caption']] = $f['xquery'];
            }
        }

        return $fields;
    }

    /**
     * 
     * @param mixed $fieldName
     * @param string $NS
     */
    function getFieldValue($fieldName, $NS, $entity)
    {
        if ($NS == 'fieldsAdsPictures') {
            // $fieldName value is the index of the array $entity->fieldsAdsPictures
            return $entity->fieldsAdsPictures[$fieldName]['xquery'];
        }

        foreach ($entity->$NS->toArray() as $f) {
            if ($f['fields_caption'] == $fieldName) {
                return $f['xquery'];
            }
        }

        return '';
    }

    /**
     * 
     * @param string $fieldName
     * @param mixed $fieldValue
     */
    function setFieldValue($fieldName, $fieldValue, $entity)
    {
        $i = 0;
        foreach ($entity->fields->toArray() as $f) {
            if ($f['fields_caption'] == $fieldName) {
                $entity->fields[$i]->xquery = $fieldValue;
                return;
            }

            $i++;
        }

        $entity->fields[]->fields_caption = $fieldName;
        $entity->fields[]->xquery = $fieldValue;
    }

    /**
     * Return Pager Urls
     * 
     * @return array
     */
    function getPageUrls()
    {
        $urls = array();

        $xpath = $entity->getFieldXquery('add_link', 'fields');
        $xpath = trim($xpath);
        if (empty($xpath))
            return $urls;

        /**
         * @TODO Този метод трябва да се премести в класа на модела Model_ParserProject
         */
        $html = $entity->getUrlContent($entity->url);

        $dom = new Zend_Dom_Query($html);
        $res = $dom->query($xpath);
        foreach ($res as $r) {
            $urls[] = $r->getAttribute('href');
        }

        return $urls;
    }

    /**
     * Return array with ads urls
     * 
     * @param string $xpath
     * @return array
     */
    function getInternalUrls()
    {
        $pUrls = array();
        if (!is_object($entity))
            return $pUrls;


        $xpath = $entity->getFieldXquery('add_link', 'fields');
        $xpath = trim($xpath);
        if (empty($xpath))
            return $pUrls;

        $pageLink = $entity->getFieldXquery('page_link', 'fields');
        $pageLink = trim($pageLink);

        /**
         * @TODO Този метод трябва да се премести в класа на модела Model_ParserProject
         */
        $html = $this->getUrlContent($entity->url);

        if (!empty($pageLink) && !empty($html)) {
            $pPageUrls = $entity->getPageUrls($pageLink, $html);
        }


        $dom = new Zend_Dom_Query($html);
        $res = $dom->query($xpath);
        foreach ($res as $r) {
            $url = $r->getAttribute('href');
            $pUrls[] = SvProject_Parser::AbsoluteUrl($entity, $url);
        }

        /*
         * All the pages

          if(!empty($pPageUrls)) {
          foreach($pPageUrls as $pu) {
          $pageHtml = $entity->_getUrlContent($pu);
          $pageUrls = $entity->_getInternalUrls($addLink, $pageHtml);
          $pUrls = array_merge($pUrls, $pageUrls);
          }
          }
         */

        if (empty($pUrls))
            return array();


        return $pUrls;
    }

    /**
     * Browse URL and return its html content
     * 
     * @deprecated since version 1.0 Moved to Utils\RemoteContent::browseUrl(url)
     * 
     * @param string $url
     * @return string
     */
    function getUrlContent($url)
    {
        $remoteContent = new IA\Bundle\WebContentThiefBundle\Utils\RemoteContent();
        
        return $remoteContent->browseUrl($url);
    }
}
