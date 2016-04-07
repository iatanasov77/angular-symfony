<?php
namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use IA\Bundle\WebContentThiefBundle\Form\Elements\ProjectListingFieldType;
use IA\Bundle\WebContentThiefBundle\Form\Elements\ProjectDetailsFieldType;
//use IA\Bundle\WebContentThiefBundle\Form\Elements\ProjectLinkType;

use IA\Bundle\WebContentThiefBundle\Entity\Project;

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
            ->add('parseCountMax', 'text', array('label' => 'Max Count Parsing Objects'))
            
            ->add('url', 'text', array('label' => 'Url')) // , array("mapped" => false)
            
            ->add('xquery', 'text', array('label' => 'XQuery', "mapped" => false, 'required' => false))
            ->add('xqueryField', 'choice', array(
                'label' => 'Set to field:',
                'required' => false,
                'mapped' => false,
                'choices' => $this->getXqueryFieldChoices($options['data'])
            ))    
            
            ->add('detailsPage', 'text', array('label'=> 'Details Page', "mapped" => false, 'required' => false))
            ->add('detailsLink', 'text', array('label'=> 'Details Link'))
            ->add('pagerLink', 'text', array('label'=> 'Pager Link'))
                
            ->add('fieldset', 'entity', array(
                'class' => 'IA\Bundle\WebContentThiefBundle\Entity\Fieldset',
                'choice_label' => 'title',
                "mapped" => false,
                'required' => false
            ))
            
                
            ->add('listingFields', 'collection', array(
                'type'         => new ProjectListingFieldType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ))
                
            ->add('detailsFields', 'collection', array(
                'type'         => new ProjectDetailsFieldType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ))
             
                
            ->add('btnSave', 'submit', array('label' => 'Save'))
            ->add('btnCancel', 'button', array('label' => 'Cancel'))
                
                
//            ->add('links', 'collection', array(
//                'type' => new ProjectLinkType(),
//                'data' => $options["data"]->getLinks(),
//                'mapped'=> false,
//                'required' => false
//            ))
        ;
        
        
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Project'
        ));
    }
    
    protected function getXqueryFieldChoices(Project $project)
    {
        $choices = array(
            'FormProject_detailsLink' => 'Details Link',
            'FormProject_pagerLink'   => 'Pager Link'
        );
        $i = 0;
        foreach($project->getListingFields() as $field) {
            $choices['FormProject_listingFields_'.$i++.'_xquery'] = $field->getTitle();
        }
        $i = 0;
        foreach($project->getDetailsFields() as $field) {
            $choices['FormProject_detailsFields_'.$i++.'_xquery'] = $field->getTitle();
        }
        
        
        return $choices;
    }
}