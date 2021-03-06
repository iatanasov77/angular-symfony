<?php

namespace IA\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;



/**
 * Page
 *
 * @ORM\Table(name="Pages"))
 * @ORM\Entity(repositoryClass="IA\Bundle\CmsBundle\Entity\Repository\PagesRepository")
 */
class Page implements Translatable
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=64)
     * @JMS\Type("string")
     */
    protected $alias;
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Type("string")
     */
    protected $title;
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="text", type="text")
     * @JMS\Type("string")
     */
    protected $text;
    
    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    /**
     * Get _id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set _alias
     *
     * @param string $alias
     * @return Page
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get _alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set _title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get _title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set _text
     *
     * @param \longtext $text
     * @return Page
     */
    public function setText(\longtext $text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get _text
     *
     * @return \longtext 
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Set Entity Translations Locale
     * 
     * @param string $locale
     * @return Page
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        
        return $this;
    }
}