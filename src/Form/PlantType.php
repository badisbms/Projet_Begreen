<?php

namespace App\Form;

use App\Entity\Plant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('frenchName')
            ->add('latinName')
            ->add('family')
            ->add('origin')
            ->add('flowering')
            ->add('planting')
            ->add('maintenance')
            ->add('notes')
            ->add('isInEncyclopedia')
            // ->add('user')
          
            //ajout champs images 
            ->add('images', FileType::class, [
                'label' => "photo obligé ",
                'multiple' => false,
                'mapped' => false,
                'required' => true,
            ])
            ->add('photos', FileType::class, [
                'label' => "photos fac",
                'multiple' => false,
                'mapped' => false,
                'required' => false,
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
