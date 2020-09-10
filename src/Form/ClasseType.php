<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Cursus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('cursus', Null, [
                'class' => Cursus::class, 
                'choice_label' => 'nom',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
