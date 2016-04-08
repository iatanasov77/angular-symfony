<?php

namespace IA\Bundle\ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactPhone
 *
 * @ORM\Table(name="ContactPhones")
 * @ORM\Entity(repositoryClass="IA\Bundle\ServerBundle\Entity\Repository\ContactPhonesRepository")
 */
class ContactPhone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=32, precision=0, scale=0, nullable=false, unique=false)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $modified;

    /**
     * @var \IA\Bundle\ServerBundle\Entity\Contact
     *
     * @ORM\ManyToOne(targetEntity="IA\Bundle\ServerBundle\Entity\Contact", inversedBy="phones", cascade={"persist","remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contactsId", referencedColumnName="id", nullable=true)
     * })
     */
    private $contact;


}
