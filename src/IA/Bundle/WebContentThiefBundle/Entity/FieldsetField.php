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
     * @ORM\Column(name="fieldsetId", type="integer", nullable=false)
     */
    private $fieldsetid;

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
     * Set fieldsetid
     *
     * @param integer $fieldsetid
     * @return WctFieldsetsFields
     */
    public function setFieldsetid($fieldsetid)
    {
        $this->fieldsetid = $fieldsetid;

        return $this;
    }

    /**
     * Get fieldsetid
     *
     * @return integer 
     */
    public function getFieldsetid()
    {
        return $this->fieldsetid;
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
