<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Domaine;
use App\Entity\Type;
use App\Entity\Membre;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('dateD', DateType::class, [
                'widget' => 'single_text',
				'label'=>'Date de début'
            ])
            ->add('dateF', DateType::class, [
                'widget' => 'single_text',
				'label'=>'Date de fin'
            ])
            ->add('photos')
            ->add('evaluation')
            
            ->add('type' ,Null, [
                'class' => Type::class, 
                'choice_label' => 'nom',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])
            ->add('domaine', Null, [
                'class' => Domaine::class, 
                'choice_label' => 'nom',
                'by_reference' =>true,
                'mapped' =>true,
				'required' => true
            ])
			 ->add('nomLieu')
            ->add('adresseLieu')
            ->add('cpLieu')
            ->add('villeLieu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
