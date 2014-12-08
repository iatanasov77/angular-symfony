<?php
namespace IA\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 */
class PageTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Type("string")
     */
    protected $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     * @JMS\Type("string")
     */
    protected $text;
    
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
}
