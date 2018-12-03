<?php

namespace App\Form;

use App\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Question;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, [
              'label'=>' ',
              'attr'=> ['placeholder'=>'The label of the answer']
            ])
            ->add('correct', ChoiceType::class, [
              'label'=>' ',
              'choices'  => [
                  'Non' => false,
                  'Oui' => true,
              ]
            ])
            ->add('question', EntityType::class, array(
              'label'=>' ',
              'class'=>Question::class,
              'choice_label'=>'label'
            ))
            ->add('submit', SubmitType::class, [
              'label'=>'Submit',
              'attr'=> ['class'=>'btn btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
        ]);
    }
}
