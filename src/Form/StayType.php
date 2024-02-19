<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Speciality;
use App\Entity\Stay;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;

class StayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reason', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Motif de votre séjour',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('start_date', DateType::class, [
                'required'  => true,
                'widget'    => 'single_text',
                'html5'     => false,
                'attr'      => ['class' => 'js-datepicker'],
                'format'        => 'dd/MM/yyyy',
                // 'input'     => 'datetime_immutable',
                'label'     =>  'Début du séjour',
                'label_attr' =>  [
                    'class'     =>  'col-form-label col-sm-4'
                ],
                'constraints'   => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir la date de début du séjour'
                    ]),

                ]
            ])
            ->add('end_date', DateType::class, [
                'required'      => true,
                'widget'        => 'single_text',
                'html5'         => false,
                'format'        => 'dd/MM/yyyy',
                'attr'          => ['class' => 'js-datepicker'],
                // 'input'         => 'datetime_immutable',
                'label'         => 'Date de fin du séjour',
                'label_attr'    =>  [
                    'class'     =>  'col-form-label col-sm-4'
                ],
                'constraints'   => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir la date de fin souhaitée du séjour',
                    ]),
                ]
            ])
            ->add('speciality', EntityType::class, [
                'class'         => Speciality::class,
                'multiple'      => false,
                'choice_label'  => 'name',
                'placeholder'   => 'Sélectionnez une spécialité',
                'label'         => 'Spécialité',
                'attr'          => [
                    'class' => 'd-flex flex-wrap gap-3 stay_speciality',
                ],
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                },
            ])
            ->add('medecin', EntityType::class, [
                'class'         => Medecin::class,
                'multiple'      => false,
                'placeholder'   => 'Sélectionnez un médecin',
                'label'         => 'Médecin',
                'attr'          => [
                    'class' => 'd-flex flex-wrap gap-3 stay_medecin',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stay::class,
        ]);
    }
}
