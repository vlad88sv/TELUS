<?php

namespace Qualium\Telus\VotacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CandidatosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surnames')
            ->add('name')
            ->add('email')
            ->add('documentNumber')
            ->add('department')
            ->add('registerDate')
            ->add('updateDate')
            ->add('idCommitee', null, array('label' => 'Comité'))
            ->add('idCountry', null, array('label' => 'País'))
            ->add('documentType')
            ->add('votes')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Qualium\Telus\VotacionBundle\Entity\Candidatos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'qualium_telus_votacionbundle_candidatos';
    }
}
