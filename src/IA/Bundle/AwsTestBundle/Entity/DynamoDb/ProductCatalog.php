<?php

namespace IA\Bundle\AwsTestBundle\Entity\DynamoDb;

use Aws\DynamoDb\Enum\Type;
use Cpliakas\DynamoDb\ODM\Entity;

class ProductCatalog extends Entity
{
    // The DynanoDB table name
    protected static $table = 'ProductCatalog';

    // The attribute containing the hash key
    protected static $hashKeyAttribute = 'Id';

    // Optionally set the $rangeKeyAttribute static if appropriate

    // Optionally enforce entity integrity
    protected static $enforceEntityIntegrity = true;

    // Optionally map attributes to data types
    protected static $dataTypeMappings = array(
        'Id' => Type::NUMBER,
        'Price' => Type::NUMBER,
        'Title' => Type::STRING,
        'ISBN' => Type::STRING,
    );

    /*
     *  Optionally add attribute setters and getters to taste
     */
    public function setId($id)
    {
        $this->setAttribute('Id', $id);
        return $this;
    }

    public function getId()
    {
        return $this->getAttribute('Id');
    }
    
    public function setPrice($price)
    {
        $this->setAttribute('Price', $price);
        return $this;
    }
    
    public function getPrice()
    {
        return $this->getAttribute('Price');
    }
    
    public function setTitle($title)
    {
        $this->setAttribute('Title', $title);
        return $this;
    }

    public function getTitle()
    {
        return $this->getAttribute('title');
    }
    
    public function setIsbn($isbn)
    {
        $this->setAttribute('ISBN', $isbn);
        return $this;
    }

    public function getIsbn()
    {
        return $this->getAttribute('ISBN');
    }
}
