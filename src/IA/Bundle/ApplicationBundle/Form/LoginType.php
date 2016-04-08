<?php

namespace IA\Bundle\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{

    public function getName()
    {
        return 'FormLogin';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('username', 'text', array('label' => 'Active'))
            ->add('password', 'password', array('label' => 'Title'))
            
            ->add('btnLogin', 'submit', array('label' => 'Login'))
            ->add('btnRegister', 'button', array('label' => 'Signup'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefaults(array(
//            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Fieldset'
//        ));
    }

}

