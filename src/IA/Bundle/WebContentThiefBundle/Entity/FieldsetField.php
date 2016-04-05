<?php

namespace IA\Bundle\WebContentThiefBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FieldsetsField
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
     *
     * @ORM\OneToOne(targetEntity="FieldsetFieldType")
     * @ORM\JoinColumn(name="typeId", referencedColumnName="id")
     */
    private $type;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Fieldset", inversedBy="fields")
     * @ORM\JoinColumn(name="fieldsetId", referencedColumnName="id")
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
     * Set type
     *
     * @param FieldsetFieldType $type
     * @return FieldsetsField
     */
    public function setType(FieldsetFieldType $type)
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
     * Set fieldset
     *
     * @param Fieldset $fieldset
     * @return WctFieldsetsFields
     */
    public function setFieldset(Fieldset $fieldset)
    {
        $this->fieldset = $fieldset;

        return $this;
    }

    /**
     * Get fieldset
     *
     * @return Fieldset
     */
    public function getFieldset()
    {
        return $this->fieldset;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FieldsetsField
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
