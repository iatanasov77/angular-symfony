<?php

namespace IA\Bundle\AwsTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Aws\DynamoDb\DynamoDbClient;
use Cpliakas\DynamoDb\ODM\DocumentManager;
use Aws\DynamoDb\Enum\ComparisonOperator;

class DynamoDbController extends Controller
{

    /**
     * DynamoDb Document Manager
     * 
     * @var DocumentManager 
     */
    protected $dm;
    
    public function indexAction()
    {
        $this->_initClient();

        /*
         * SEARCH Documents
         */
        // Search for books published after 2010 that don't have the title "Do not read me"
        $conditions = Conditions::factory()
                ->addCondition('title', 'Do not read me', ComparisonOperator::NE)
                ->addCondition('copyright', 2010, ComparisonOperator::GT)
        ;

        // Search for books with existing attribute 'extra'
        $conditions = Conditions::factory()
                ->addNotNullCondition('extra')
        ;

        $result = $this->dm->scan('Book', $conditions);
        var_dump($result);

        return new Response('TEST Amazon Dynamo DB.');
    }

    public function editAction()
    {
        $this->_initClient();
        
    
        /*
         * UPDATE Document
         */
        // Read the document
        $book = $this->dm->read('Book', '0-1234-5678-9');

        // Update the document
        $book['title'] = 'Revised title';
        $this->dm->update($book);

        
        $this->dm->flush();
    }
    
    public function deleteAction()
    {
        $this->_initClient();
        
        /*
         * DELETE Document
         */
        // Read the document
        $book = $this->dm->read('Book', '0-1234-5678-9');
        
        // Delete the document
        $this->dm->delete($book);


        // Bulk delete
//        foreach($books as $book) {
//            $this->dm->deleteBatch($book);
//        }
        $this->dm->flush();
    }

    public function creteAction()
    {
        $this->_initClient();

        /*
         * CREATE Document
         */
        // Instantiate the entity object to model the new document. "Book" is the
        // entity's class name as defined in the "Defining Entities" example above.
        $book = $this->dm->entityFactory('Book')
                ->setHashKey('0-1234-5678-9')
                ->setAttribute('title', 'The Book Title')
                ->setAttribute('author', 'Chris Pliakas')
        ;

        // Documents can also act like arrays
        $book['copyright'] = 2014;

        // Save the document
        $this->dm->create($book);

        // Bulk insert
//        foreach($books as $book) {
//            $this->dm->createBatch($book);
//        }
        $this->dm->flush();

        return new Response('TEST Amazon Dynamo DB.');
    }

    protected function _initClient()
    {
        $dynamoDb = DynamoDbClient::factory(array(
                    'key' => '<public-key>',
                    'secret' => '<secret-key>',
                    'region' => '<aws-region>',
        ));
        $this->dm = new DocumentManager($dynamoDb);

        // Register one or more namespaces that contain entities in order to avoid
        // having to pass the fully qualified class names as arguments.
        $this->dm->registerEntityNamesapce('IA\Bundle\AwsTest\Entity');
    }

}
