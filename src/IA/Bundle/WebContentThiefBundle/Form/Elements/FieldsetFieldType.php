<?php

namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldsetFieldType extends AbstractType
{

    public function getName()
    {
        return 'FormFieldsetField';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('type', 'entity', array(
                'class' => 'IA\Bundle\WebContentThiefBundle\Entity\FieldType',
                'choice_label' => 'title'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\FieldsetField'
        ));
    }

}

