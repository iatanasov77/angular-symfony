<?php

namespace IA\Bundle\AwsTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        // Get a AmazonSQS object
        $s3 = $this->container->get('aws_s3');
        $listBuckets = $s3->listBuckets();
        $listObjects = $s3->listObjects(array('Bucket'=>'iatanasov'));
        foreach($listObjects as $obj) {
            var_dump($obj);
        }
        die;
        var_dump($listObjects); die;
        var_dump($listBuckets); die;
        
        return $this->render('IAAwsTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
