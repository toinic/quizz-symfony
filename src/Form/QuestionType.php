<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, [
              'label'=>' ',
              'attr'=> ['placeholder'=>'The label of the question']
            ])
            // ->add('difficulty', IntegerType::class, [
            //   'attr'=> ['value'=>'1']
            // ])
            ->add('difficulty', ChoiceType::class, [
              'label'=>' ',
              'choices'  => [
                  'Select difficulty number' => null,
                  '1' => 1,
                  '2' => 2,
                  '3' => 3
              ]
            ])
            ->add('category', EntityType::class, array(
              'label'=>' ',
              'class'=>Category::class,
              'choice_label'=>'name'
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
            'data_class' => Question::class,
        ]);
    }
}
