<?php

namespace IA\Bundle\AwsTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Enum\ComparisonOperator;
use Cpliakas\DynamoDb\ODM\DocumentManager;
use Cpliakas\DynamoDb\ODM\Conditions;

class DynamoDbController
        extends Controller
{

    protected $dm;

    public function indexAction()
    {
        $this->_initDynamoDbClient();
        
//        $conditions = Conditions::factory()
//            ->addCondition('Title', 'Do not read me', ComparisonOperator::NE)
//            ->addCondition('Price', 2, ComparisonOperator::GT)
//        ;

        // Search for books with existing attribute 'extra'
//        $conditions = Conditions::factory()
//            ->addNotNullCondition('ISBN')
//        ;
        
//        $conditions = Conditions::factory()
//            ->addCondition('Price', 2, ComparisonOperator::GT)
//        ;
        
        $conditions = Conditions::factory()
            ->addCondition('ProductCategory', 'Bicycle', ComparisonOperator::NE)
        ;
        
        $conditions = Conditions::factory()
            ->addCondition('ProductCategory', 'Bicycle', ComparisonOperator::EQ)
        ;
        
       
        //$result = $this->dm->scan('ProductCatalog', $conditions);
        $result = $this->dm->query('ProductCatalog', array());

        var_dump($result); die;
        
        return $this->render('IAAwsTestBundle:Default:index.html.twig');
    }

    public function createAction()
    {
        $this->_initDynamoDbClient();


        // Instantiate the entity object to model the new document. "ProductCatalog" is the
        // entity's class name as defined in the "Defining Entities" example above.
        $productCatalog = $this->dm->entityFactory('ProductCatalog')
                ->setHashKey('0-1234-5678-9')
                ->setAttribute('Title', 'The ProductCatalog Title')
                ->setAttribute('author', 'Chris Pliakas')
        ;

        // Documents can also act like arrays
        //$productCatalog['copyright'] = 2014;
        // Save the document
        $this->dm->create($productCatalog);

        // Bulk insert
        foreach($productCatalogs as $productCatalog) {
            $this->dm->createBatch($productCatalog);
        }
        $this->dm->flush();
        
        var_dump($result); die;
        
        return $this->render('IAAwsTestBundle:Default:index.html.twig');
    }

    public function readUpdateDeleteAction()
    {
        $this->_initDynamoDbClient();
        
        // Read the document
        $productCatalog = $this->dm-->read('ProductCatalog', '0-1234-5678-9');

        // Update the document
        $productCatalog['title'] = 'Revised title';
        $this->dm-->update($productCatalog);

        // Delete the document
        $this->dm-->delete($productCatalog);


        // Bulk delete
        foreach($productCatalogs as $productCatalog) {
            $this->dm-->deleteBatch($productCatalog);
        }
        $this->dm-->flush();
        
        var_dump($result); die;
        
        return $this->render('IAAwsTestBundle:Default:index.html.twig');
    }

    protected function _initDynamoDbClient()
    {
        $dynamoDb = DynamoDbClient::factory(array(
                    'key' => $this->container->getParameter('aws_key'),
                    'secret' => $this->container->getParameter('aws_secret'),
                    'region' => $this->container->getParameter('aws_region'),
        ));

        $this->dm = new DocumentManager($dynamoDb);

        // Register one or more namespaces that contain entities in order to avoid
        // having to pass the fully qualified class names as arguments.
        $this->dm->registerEntityNamesapce('IA\Bundle\AwsTestBundle\Entity\DynamoDb');
    }

}
