<?php
namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function getName()
    {
        return 'FormProject';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentUrl', 'text', array("mapped" => false))
            ->add('projectTitle', 'text')
            ->add('addressBar', 'text', array("mapped" => false))
            ->add('projectFields', 'collection', array("mapped" => false))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Project'
        ));
    }
}