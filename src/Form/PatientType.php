<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adlibelle', TextareaType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '250',
                ],
                'label'         =>  'Adresse',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 250]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre adresse'
                    ])
                ]
            ])
            ->add('adcp', TextType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '5',
                    'maxlength' => '10',
                ],
                'label'         =>  'Code postal',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre code postal'
                    ])
                ]
            ])
            ->add('adcity', TextType::class, [
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'         =>  'Ville',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre ville'
                    ])
                ]
            ])
            ->add('adcountry', CountryType::class, [

                'preferred_choices' => array('FR'),
                'choice_translation_locale' => null,
                'attr'  => [
                    'class'     =>  'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'         =>  'Pays',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label'
                ],
                'constraints'   => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir votre pays'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
