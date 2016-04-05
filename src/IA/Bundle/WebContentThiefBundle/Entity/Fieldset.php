<?php

namespace IA\Bundle\WebContentThiefBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Fieldset
 *
 * @ORM\Table(name="WCT_Fieldsets")
 * @ORM\Entity
 */
class Fieldset
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=true)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="FieldsetField", mappedBy="fieldset" ,cascade={"persist"})
     */
    public $fields;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WctFieldsets
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return WctFieldsets
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    
    function getFields() 
    {
        return $this->fields->toArray();
    }
    
    public function addField(FieldsetField $field)
    {
        if(!$this->fields->contains($field)) {
            $field->setFieldset($this);
            $this->fields->add($field);
        }
        
        return $this;
    }
    
    public function removeField(FieldsetField $field)
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
        }
        
        return $this;
    }
}
