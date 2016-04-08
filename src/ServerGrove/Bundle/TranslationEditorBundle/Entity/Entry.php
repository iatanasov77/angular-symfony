<?php

namespace ServerGrove\Bundle\TranslationEditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Table(name="sg_translation_entry")
 * @ORM\Entity
 */
class Entry
{
    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=50)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=50)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=5)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string")
     */
    private $alias;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ServerGrove\Bundle\TranslationEditorBundle\Entity\Translation", mappedBy="entry", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
