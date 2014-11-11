<?php

namespace IA\Bundle\ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;


/**
 * @ORM\Entity(repositoryClass="IA\Bundle\ServerBundle\Entity\Repository\ContactPhonesRepository")
 * @ORM\Table(name="ContactPhones")
 * @ORM\HasLifecycleCallbacks
 */
class ContactPhone
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32)
     * @JMS\Type("string")
     * @JMS\SerializedName("phoneNumber")
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(type="text")
     * @JMS\Type("string")
     */
    protected $description;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="phones", cascade={"persist", "remove" })
     * @ORM\JoinColumn(name="contactsId", referencedColumnName="id")
     */
    protected $contact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @JMS\Type("DateTime")
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     * @JMS\Type("DateTime")
     */
    protected $modified;


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
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return ContactPhone
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ContactPhone
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ContactPhone
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return ContactPhone
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set contact
     *
     * @param \IA\Bundle\ServerBundle\Entity\Contact $contact
     * @return ContactPhone
     */
    public function setContact(\IA\Bundle\ServerBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return \IA\Bundle\ServerBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
}
