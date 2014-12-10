<?php

namespace IA\Bundle\MultiLanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;



/**
 * Page
 *
 * @ORM\Table(name="Languages"))
 * @ORM\Entity(repositoryClass="IA\Bundle\MultiLanguageBundle\Entity\Repository\LanguagesRepository")
 */
class Language implements Translatable
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
    protected $code;
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Type("string")
     */
    protected $title;
    
    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;
    
    
}
