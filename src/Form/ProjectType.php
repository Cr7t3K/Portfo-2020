<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('domain')
            ->add('link')
            ->add('github')
            ->add('main_image')
            ->add('createdAt', DateType::class, [
                "label" => "Created Year ",
                'format' => 'dd MM yyyy',
                "placeholder"  => ['year' => 'Année'],
                'years' => range(2020, 1920),
            ])
            ->add('concept')
            ->add('number')
            ->add('teams', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
