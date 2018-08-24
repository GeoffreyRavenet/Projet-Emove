<?php

namespace EmotionBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date_rental', DateType::class,
                    [
                        'widget' => 'single_text',
                        'label' => 'Du',
                        'attr'=> ['class'=>'dateTakeLocation'],
                    ]
                )
				->add('date_delivery', DateType::class,
                    [
                        'attr'=> ['class'=>'dateGiveLocation'],
                        'widget' => 'single_text',
				        'label' => 'Au',
                    ]
                )
                ->add('totalPrice', HiddenType::class, array(
                    'data' => '0',
                ))
                ->add('invoice', HiddenType::class)
                ->add('user', HiddenType::class)
                ->add('product', HiddenType::class)
                ->add('save', SubmitType::class, array(
                    'label'=>'Valider',
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmotionBundle\Entity\Rent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'emotionbundle_rent';
    }


}
