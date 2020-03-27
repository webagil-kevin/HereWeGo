<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\EventSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class EventSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', TextType::class, [
                'required' => false,
                'label' => 'Titre et description',
                'attr' => [
                    'placeholder' => 'Recherche textuelle'
                ]
            ])
            ->add('categories', EntityType::class, [
                'required' => false,
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => 'title',
                'multiple' => false
            ])
            ->add('cities', Select2EntityType::class, [
                'remote_route'         => 'city_select',
                'class'                => 'App\Entity\City',
                'required'             => false,
                'allow_clear'          => true,
                'label'                => 'Ville',
                'placeholder'          => 'Saisir une ville ou un code postal',
                'multiple'             => false,
                'minimum_input_length' => 3,
                'property'             => 'name',
                'language'             => 'fr'
            ])
            ->add('distance', ChoiceType::class, [
                'choices'  => [
                    '10 kms'  => 10,
                    '25 kms'  => 25,
                    '50 kms'  => 50,
                    '100 kms' => 100,
                    '250 kms' => 250,
                    '500 kms' => 500,
                ],
                'required' => false,
                'label'    => 'Distance',
                'multiple' => false
            ])
            ->add('start', DateType::class, [
                'required' => false,
                'label'    => 'A partir du',
                'html5'    => true,
                'widget'   => 'single_text'
            ])
            ->add('end', DateType::class, [
                'required' => false,
                'label' => 'Jusqu\'au',
                'html5' => true,
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
