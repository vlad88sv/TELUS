<?php

namespace Qualium\Telus\VotacionBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('idCountry', null, array('label'  => 'País'));

    }

    public function getName()
    {
        return 'qualium_user_registration';
    }
}