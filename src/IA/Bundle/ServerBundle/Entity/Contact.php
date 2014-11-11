<?php

namespace IA\Bundle\ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * Contact
 *
 * @ORM\Table(name="Contacts"))
 * @ORM\Entity(repositoryClass="IA\Bundle\ServerBundle\Entity\Repository\ContactsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=32)
     * @JMS\Type("string")
     * @JMS\SerializedName("firstName")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=32)
     * @JMS\Type("string")
     * @JMS\SerializedName("lastName")
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @JMS\Type("string")
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=32)
     * @JMS\Type("string")
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="ContactPhone", mappedBy="contact", cascade={"persist", "remove" })
     * @JMS\Type("array<IA\Bundle\ServerBundle\Entity\ContactPhone>")
     */
    protected $phones;

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
     * Defaault Constructor is called when create new entity only
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setModified(new \DateTime());

        $phone = new ContactPhone();
        $phone->setPhoneNumber('');
        $phone->setDescription('');

        $this->phones = array($phone);
    }

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
     * Set firstName
     *
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    

    /**
     * Add phones
     * 
     * @param \IA\Bundle\ServerBundle\Entity\ContactPhone $phone
     */
    public function addPhone(ContactPhone $phone)
    {
        $this->phones[] = $phone;
    }

    /**
     * Set phones
     * 
     * @param array
     */
    public function setPhones($phones)
    {
        return $this->phones = $phones;
    }
    
    /**
     * Get phones
     * 
     * @return array
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Contact
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
     * @return Contact
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
     * Remove phone
     *
     * @param \IA\Bundle\ServerBundle\Entity\ContactPhone $phone
     */
    public function removePhone(\IA\Bundle\ServerBundle\Entity\ContactPhone $phone)
    {
        $this->phones->removeElement($phone);
    }


}