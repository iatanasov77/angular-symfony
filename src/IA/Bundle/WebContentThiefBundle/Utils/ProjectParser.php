<?php
namespace IA\Bundle\WebContentThiefBundle\Utils;

use Symfony\Component\DomCrawler\Crawler;

use IA\Bundle\WebContentThiefBundle\Entity\Project;

class ProjectParser
{
    protected $crawler;
    
    protected $project;
    
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->_createCrawler($this->project->getUrl());
    }
    
    public function parse()
    {   
        $parserItems = array();
        $itemUrls = $this->_getItemUrls();
        
        $count = 0;
        foreach($itemUrls as $url) {
            $count++;
            $this->_createCrawler($url);
            $parserItems[$url] = array();
            foreach($this->project->getDetailsFields() as $field) {
                $parsedField = $this->crawler->filterXPath($field->getXquery());
                $parserItems[$url][$field->getTitle()] = $parsedField->count() ? $parsedField->text() : '';
            }
            
            if($count == $this->project->getParseCountMax())
                break;
        }
 
        return $parserItems;
    }
    
    protected function _getItemUrls()
    {
        /*
         * Fetch Pages Urls
         */
        $pageUrls = $this->crawler->filterXPath($this->project->getPagerLink())->each(function (Crawler $node, $i) {
            return $node->attr('href');
        });
        
        $itemUrls = $this->_getPageItemUrls();
        if(count($itemUrls) >= $this->project->getParseCountMax())
            return $itemUrls;
      
        
        foreach($pageUrls as $pUrl) {
            $this->_createCrawler($pUrl);
            $itemUrls = array_unique(array_merge($itemUrls, $this->_getPageItemUrls()));
            if(count($itemUrls) >= $this->project->getParseCountMax())
                break;
        }

        return $itemUrls;
    }
    
    protected function _getPageItemUrls()
    {
        /*
         * Fetch Item Urls ( ... and Listing Page Fields may be ... )
         */
        $itemUrls = $this->crawler->filterXPath($this->project->getDetailsLink())->each(function (Crawler $node, $i) {
            return $node->attr('href');
        });
      
        return $itemUrls;
    }
    
    protected function _createCrawler($url)
    {
        $remoteContent = new RemoteContent();
        $html = $remoteContent->browseUrl($url);
        $this->crawler = new Crawler($html);
    }
}
