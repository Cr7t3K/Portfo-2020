<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Skill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mainSentence', null, [
                "label" => "Main sentence :",
                'attr' => ['placeholder' => 'Titre de la page d\'aceuil'],
            ])
            ->add('sentence1', null, [
                "label" => "Second sentence :",
                'attr' => ['placeholder' => 'Titre de la page d\'aceuil'],
            ])
            ->add('sentence2', null, [
                "label" => "Third Sentence :",
                'attr' => ['placeholder' => 'Titre de la page d\'aceuil'],
            ])
            ->add('sentence3', null, [
                "label" => "Fourth sentence :",
                'attr' => ['placeholder' => 'Titre de la page d\'aceuil'],
            ])
            ->add('sentence4', null, [
                "label" => "Fifth sentence :",
                'attr' => ['placeholder' => 'Titre de la page d\'aceuil'],
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
            'data_class' => Page::class,
        ]);
    }
}
