<?php

namespace IA\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Page
 *
 * @ORM\Table(name="Pages"))
 * @ORM\Entity(repositoryClass="IA\Bundle\CmsBundle\Entity\Repository\PagesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=64)
     */
    protected $_alias;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $_title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    protected $_text;

    /**
     * Get _id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set _alias
     *
     * @param string $alias
     * @return Page
     */
    public function setAlias($alias)
    {
        $this->_alias = $alias;
    
        return $this;
    }

    /**
     * Get _alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * Set _title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    
        return $this;
    }

    /**
     * Get _title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set _text
     *
     * @param \longtext $text
     * @return Page
     */
    public function setText(\longtext $text)
    {
        $this->_text = $text;
    
        return $this;
    }

    /**
     * Get _text
     *
     * @return \longtext 
     */
    public function getText()
    {
        return $this->_text;
    }
}