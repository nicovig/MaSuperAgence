<?php

namespace App\Form;

use App\Entity\PropertySearch;
use App\Entity\Specifications;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface', IntegerType::class, [
                        'required' => false,
                        'label' => false,
                        'attr' => [
                            'placeholder' => 'Surface minimale'
                        ]
            ])
            ->add('maxPrice', IntegerType::class, [
                        'required' => false,
                        'label' => false,
                        'attr' => [
                            'placeholder' => 'Prix maximum'
                        ]
            ])
            ->add('specifications', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Specifications::class,
                'choice_label' => 'name',
                'multiple' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
