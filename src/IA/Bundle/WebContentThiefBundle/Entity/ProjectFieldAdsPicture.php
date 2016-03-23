<?php

namespace IA\Bundle\WebContentThiefBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WctProjectfieldadspicture
 *
 * @ORM\Table(name="WCT_ProjectFieldAdsPicture")
 * @ORM\Entity
 */
class ProjectFieldAdsPicture
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="fieldsAdsPicture")
     */
    public $project;
    
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
     * @ORM\Column(name="xquery", type="string", length=128, nullable=false)
     */
    private $xquery;

    /**
     * @var string
     *
     * @ORM\Column(name="regex", type="string", length=128, nullable=false)
     */
    private $regex;

    /**
     * @var string
     *
     * @ORM\Column(name="replace", type="string", length=45, nullable=false)
     */
    private $replace;



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
     * @return WctProjectfieldadspicture
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
     * Set xquery
     *
     * @param string $xquery
     * @return WctProjectfieldadspicture
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

    /**
     * Set regex
     *
     * @param string $regex
     * @return WctProjectfieldadspicture
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;

        return $this;
    }

    /**
     * Get regex
     *
     * @return string 
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * Set replace
     *
     * @param string $replace
     * @return WctProjectfieldadspicture
     */
    public function setReplace($replace)
    {
        $this->replace = $replace;

        return $this;
    }

    /**
     * Get replace
     *
     * @return string 
     */
    public function getReplace()
    {
        return $this->replace;
    }
}
