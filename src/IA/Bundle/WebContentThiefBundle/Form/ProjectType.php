<?php
namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function getName()
    {
        return 'FormProject';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('active', 'checkbox', array('label' => 'Active'))
            ->add('title', 'text', array('label' => 'Title'))
            
            ->add('url', 'text', array('label' => 'Url')) // , array("mapped" => false)
            ->add('xquery', 'text', array('label' => 'XQuery', "mapped" => false))
            ->add('xqueryField', 'choice', array(
                'label' => 'Set to field:',
                'mapped' => false,
                'choices' => array(
                    'FormProject_detailsLink' => 'Details Link',
                    'FormProject_pagerLink' => 'Pager Link',
                )
            ))    
                
                
            // General XPath Fields
            ->add('detailsLink', 'text', array('label' => 'Details Link'))
            ->add('pagerLink', 'text', array('label' => 'Pager Link'))
                
            ->add('fieldset', 'entity', array(
                'class' => 'IA\Bundle\WebContentThiefBundle\Entity\Fieldset',
                'choice_label' => 'title',
                "mapped" => false
            ))
                
            ->add('fields', 'collection', array(
                'type'         => new ProjectFieldType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ))
                
            ->add('btnSave', 'submit', array('label' => 'Save'))
            ->add('btnCancel', 'button', array('label' => 'Cancel'))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Project'
        ));
    }
}