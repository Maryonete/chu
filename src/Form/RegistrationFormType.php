<?php

namespace App\Form;

use App\Entity\User;
use App\Form\PatientType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'         =>  'E-mail',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 80]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre email'
                    ])
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'         =>  'Nom',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre nom de famille'
                    ])
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'         =>  'Prénom',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre prénom'
                    ])
                ]
            ])
            ->add('patient', PatientType::class)
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options' => [
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Veuillez renseigner un mot de passe',
                            ]),
                            new Length([
                                'min' => 8,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                        ],
                        'label' => 'Mot de passe',
                        'label_attr'    =>  [
                            'class'     =>  'col-form-label'
                        ],
                        'attr'  => [
                            'class'     =>  'form-control',
                        ],
                    ],
                    'second_options' => [
                        'label' => 'Répéter le mot de passe',
                        'label_attr'    =>  [
                            'class'     =>  'col-form-label'
                        ],
                        'attr'  => [
                            'class'     =>  'form-control',
                        ],
                    ],

                    'invalid_message' => 'Les mots de passe ne correspondent pas',
                    // Instead of being set onto the object directly,
                    // this is read and encoded in the controller

                    // 'options' => [
                    //     'attr' => [
                    //         'autocomplete' => 'new-password',
                    //     ],
                    // ],
                    // 'attr'      => [
                    //     'autocomplete'  => 'new-password',
                    //     'class'         =>  'form-control',
                    // ],
                    // 'label'         =>  'Mot de passe',
                    // 'label_attr'    =>  [
                    //     'class'     =>  'col-form-label'
                    // ],
                    // 'constraints' => [
                    //     new NotBlank([
                    //         'message' => 'Veuillez saisir un mot de passe',
                    //     ]),
                    //     new Length([
                    //         'min' => 6,
                    //         'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractéres',
                    //         // max length allowed by Symfony for security reasons
                    //         'max' => 4096,
                    //     ]),
                    // ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
