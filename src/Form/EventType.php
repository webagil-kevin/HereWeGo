<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('start', DateTimeType::class, ['html5' => true, 'widget' => 'single_text'])
            ->add('end', DateTimeType::class, ['html5' => true, 'widget' => 'single_text'])
            ->add('address')
            ->add('city', Select2EntityType::class, [
                'remote_route' => 'city_select',
                'class' => 'App\Entity\City',
                'required' => true,
                'multiple' => false,
                'minimum_input_length' => 3,
                'property' => 'name',
                'language' => 'fr',
                'placeholder' => 'Choisir ...'
            ])
            ->add('phone', TelType::class, ['required'=> false])
            ->add('website', UrlType::class, ['required'=> false])
            ->add('mail', EmailType::class, ['required'=> false])
            ->add('description', null, ['attr' => ['rows' => 10]])
            ->add('category')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'translation_domain'=> 'forms'
        ]);
    }
}
