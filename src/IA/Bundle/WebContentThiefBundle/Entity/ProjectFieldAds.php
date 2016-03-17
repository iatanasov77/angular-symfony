<?php

namespace IA\Bundle\WebContentThiefBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WctProjectfieldads
 *
 * @ORM\Table(name="WCT_ProjectFieldAds")
 * @ORM\Entity
 */
class ProjectFieldAds
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
     * @ORM\Column(name="projectId", type="integer", nullable=false)
     */
    private $projectid;

    /**
     * @var string
     *
     * @ORM\Column(name="fieldTitle", type="string", length=256, nullable=false)
     */
    private $fieldtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="xquery", type="string", length=256, nullable=false)
     */
    private $xquery;



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
     * Set projectid
     *
     * @param integer $projectid
     * @return WctProjectfieldads
     */
    public function setProjectid($projectid)
    {
        $this->projectid = $projectid;

        return $this;
    }

    /**
     * Get projectid
     *
     * @return integer 
     */
    public function getProjectid()
    {
        return $this->projectid;
    }

    /**
     * Set fieldtitle
     *
     * @param string $fieldtitle
     * @return WctProjectfieldads
     */
    public function setFieldtitle($fieldtitle)
    {
        $this->fieldtitle = $fieldtitle;

        return $this;
    }

    /**
     * Get fieldtitle
     *
     * @return string 
     */
    public function getFieldtitle()
    {
        return $this->fieldtitle;
    }

    /**
     * Set xquery
     *
     * @param string $xquery
     * @return WctProjectfieldads
     */
    public function setXquery($xquery)
    {
        $this->xquery = $xquery;

        return $this;
    }

    /**
     * Get xquery
     *
     * @return string 
     */
    public function getXquery()
    {
        return $this->xquery;
    }
}
