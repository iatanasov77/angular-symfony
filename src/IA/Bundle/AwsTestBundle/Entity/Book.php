<?php
namespace Acme\Entity;

use Aws\DynamoDb\Enum\Type;
use Cpliakas\DynamoDb\ODM\Entity;

class Book extends Entity
{
    // The DynanoDB table name
    protected static $table = 'books';

    // The attribute containing the hash key
    protected static $hashKeyAttribute = 'isbn';

    // Optionally set the $rangeKeyAttribute static if appropriate

    // Optionally enforce entity integrity
    protected static $enforceEntityIntegrity = true;

    // Optionally map attributes to data types
    protected static $dataTypeMappings = array(
        'isbn' => Type::STRING,
    );

    // Optionally add attribute setters and getters to taste
    public function setIsbn($isbn)
    {
        $this->setAttribute('isbn', $isbn);
        return $this;
    }

    public function getIsbn()
    {
        return $this->getAttribute('isbn');
    }
}
