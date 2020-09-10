<?php

namespace App\Form;

use App\Entity\NoteMatiere;
use App\Entity\Membre;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMatiere' ,Null, [
                "label" => "Nom Matière"
            ])
            ->add('classe' ,Null, [
                'class' => Classe::class, 
                'choice_label' => 'nom',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])

            ->add('formateur' ,Null, [
                'class' => Membre::class, 
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
            'data_class' => NoteMatiere::class,
        ]);
    }
}
