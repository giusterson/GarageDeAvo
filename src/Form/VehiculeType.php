<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;
use Vich\UploaderBundle\Form\Type\VichImageType;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('imageFile', VichImageType::class, [
                'label'=> 'Image du véhicule',
                'label_attr' => [
                    'class'=> 'form-label mt-4',
                ]
            ])

            ->add('immatriculation')
            ->add('prix', MoneyType::class, [
                'label' => 'prix',
                'constraints' => [
                  new Positive(
                    message: 'Le prix ne peut être négatif'
                  )  
                ]
            ])
            ->add('anneeMiseEnCirculation')
            ->add('kms')
            ->add('estDisponible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
