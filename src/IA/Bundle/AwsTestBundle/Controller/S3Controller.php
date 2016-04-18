<?php

namespace IA\Bundle\AwsTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class S3Controller extends Controller
{
    public function indexAction()
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
