<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\CarCategory;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '255',
                ],
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('nbSeats', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Seats number',
                'label_attr' => [
                    'class' =>  'form-label mt-4'
                ],
            ])
            ->add('nbDoors', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Doors number',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('cost', MoneyType::class, [
                'currency' => '€',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Cost',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('image', UrlType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('category', EntityType::class, [
                'placeholder' => 'Choose a category',
                'class' => CarCategory::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => 'Category',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
