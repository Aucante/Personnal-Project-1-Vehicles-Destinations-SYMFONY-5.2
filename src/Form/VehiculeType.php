<?php

namespace App\Form;

use App\Entity\Vehicule;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', ChoiceType::class, [
                'label' => 'VEHICLE',
                'choices' => [
                    'Motorbike' => 'Motorbike',
                    'Plane' => 'Plane'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'DESCRIPTION',
                'required' => false,
            ])
            ->add('note')
            ->add('backdrop', ChoiceType::class, [
                'label' => 'IMAGE',
                'choices' => [
                    'Motorbike' => 'motorbike1.jpg',
                    'Plane' => 'hydravion1.jpg'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
