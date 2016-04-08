<?php

namespace ServerGrove\Bundle\TranslationEditorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Translation
 *
 * @ORM\Table(name="sg_translation_value")
 * @ORM\Entity
 */
class Translation
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ServerGrove\Bundle\TranslationEditorBundle\Entity\Entry
     *
     * @ORM\ManyToOne(targetEntity="ServerGrove\Bundle\TranslationEditorBundle\Entity\Entry", inversedBy="translations", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entry_id", referencedColumnName="id")
     * })
     */
    private $entry;

    /**
     * @var \ServerGrove\Bundle\TranslationEditorBundle\Entity\Locale
     *
     * @ORM\ManyToOne(targetEntity="ServerGrove\Bundle\TranslationEditorBundle\Entity\Locale", inversedBy="translations", cascade={"persist","refresh"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     * })
     */
    private $locale;


}
