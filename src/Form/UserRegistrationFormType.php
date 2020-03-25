<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Choose a password!'
                    ]),
                    new Length([
                        'min'        => 7,
                        'minMessage' => 'Come on, you can think of a password longer than that!'
                    ])
                ]
            ])
            ->add('lastname')
            ->add('firstname')
            ->add('phone')
            ->add('address')
            ->add('city', Select2EntityType::class, [
                'remote_route'         => 'city_select',
                'class'                => 'App\Entity\City',
                'required'             => true,
                'multiple'             => false,
                'minimum_input_length' => 3,
                'property'             => 'name',
                'language'             => 'fr',
                'placeholder'          => 'Choisir ...'
            ])
            ->add('avatarFile', FileType::class, [
                'label'       => 'Image avatar (Format .JPG)',
                'required'    => false,
                'constraints' => [
                    new File([
                        'maxSize'          => '4096k',
                        'mimeTypes'        => [
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Sélectionnez une image valide.',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
