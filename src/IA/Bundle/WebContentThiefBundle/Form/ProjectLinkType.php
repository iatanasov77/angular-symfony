<?php

namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectLinkType extends AbstractType
{

    public function getName()
    {
        return 'FormProjectLink';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('xquery', 'hidden', array('mapped'=> false, 'required' => false))
            ->add('link', 'text', array('mapped'=> false, 'required' => false))
            ->add('browse', 'button')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\ProjectField'
        ));
    }

}

