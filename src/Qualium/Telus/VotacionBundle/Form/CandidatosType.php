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
            ->add('documentType')
            ->add('documentNumber')
            ->add('idCountry', null, array('label' => 'País'))
            ->add('department')
            ->add('idCommitee', null, array('label' => 'Comité'))
            ->add('votes')
            ->add('registerDate', null, array('data' => new \DateTime()))
            ->add('updateDate', null, array('data' => new \DateTime()))
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
