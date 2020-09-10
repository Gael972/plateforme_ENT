<?php

namespace App\Form;

use App\Entity\NoteDevoir;
use App\Entity\NoteMatiere;
use App\Entity\NoteTypeDevoir;
use App\Entity\Classe;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteDevoirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('date', DateType::class, [
                'widget' => 'single_text',
				'label'=>'Date du devoir'
            ])
            ->add('nom')
            ->add('coefficient')
        

            ->add('matiere' ,Null, [
                'class' => NoteMatiere::class, 
                'choice_label' => 'nomMatiere',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])

            ->add('typeDevoir' ,Null, [
                'class' => NoteTypeDevoir::class, 
                'choice_label' => 'nom',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])

            ->add('classe' ,Null, [
                'class' => Classe::class, 
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
            'data_class' => NoteDevoir::class,
        ]);
    }
}
