<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\Person;
use App\Repository\PersonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'The Rock, Battle Royale, La vie est belle, ...',
                ],
            ])
            ->add('summary', null, [
                'label' => 'Description',
            ])
            ->add('poster', UrlType::class, [
                'label' => 'URL de l\'image',
            ])
            ->add('releasedAt', null, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
            ])
            ->add('allPublic', ChoiceType::class, [
                'label' => 'Classification',
                'choices' => [
                    'Tout public' => true,
                    'Public averti' => false,
                ],
                'expanded' => true,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'expanded' => true,
                'label' => 'Catégorie',
            ])
            ->add('director', EntityType::class, [
                'class' => Person::class,
                'query_builder' => function (PersonRepository $er) {
                    return $er->createQueryBuilder('p')->orderBy('p.lastname', 'ASC');
                },
                'choice_label' => function (Person $person) {
                    return $person->getFirstname() . ' ' . $person->getLastname();
                },
                'label' => 'Réalisateur',
            ])
            ->add('actors', EntityType::class, [
                'class' => Person::class,
                'multiple' => true,
                'label' => 'Acteurs',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
