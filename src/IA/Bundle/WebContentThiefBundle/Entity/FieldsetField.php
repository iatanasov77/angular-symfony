<?php

namespace IA\Bundle\WebContentThiefBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WctFieldsetsFields
 *
 * @ORM\Table(name="WCT_Fieldsets_Fields")
 * @ORM\Entity
 */
class FieldsetField
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
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="FieldsetFieldType")
     * @ORM\JoinColumn(name="typeId", referencedColumnName="id")
     */
    private $type;
    
    /**
     * @var integer
     * 
     * @ORM\ManyToOne(targetEntity="Fieldset", inversedBy="fields")
     * @ORM\Column(name="fieldsetId", type="integer", nullable=false)
     */
    private $fieldset;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=false)
     */
    private $title;



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
     * Set typeid
     *
     * @param integer $type
     * @return WctFieldsetsFields
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return FieldsetFieldType
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set fieldsetid
     *
     * @param integer $fieldset
     * @return WctFieldsetsFields
     */
    public function setFieldset($fieldset)
    {
        $this->fieldset = $fieldset;

        return $this;
    }

    /**
     * Get fieldset
     *
     * @return FieldsetFieldType
     */
    public function getFieldset()
    {
        return $this->fieldset;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WctFieldsetsFields
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
}
