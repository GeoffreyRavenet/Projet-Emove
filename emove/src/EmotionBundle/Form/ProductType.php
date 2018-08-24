<?php

namespace EmotionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array (
                'label'=>'Prénom',
            ))
            ->add('category', EntityType::class, array(
                'class'    => 'EmotionBundle:ProductCategory',
                'choice_label' => 'category',
                'label' => 'Catégorie du véhicule',
                'multiple' => false))
            ->add('brand', EntityType::class, array(
                'class'    => 'EmotionBundle:Brand',
                'choice_label' => 'brand',
                'label' => 'Marque',
                'multiple' => false))
            ->add('model', EntityType::class, array(
                'class'    => 'EmotionBundle:Model',
                'choice_label' => 'model',
                'label' => 'Modèle',
                'multiple' => false))
            ->add('year', DateType::class, array (
                'label'=>'Année',
            ))
            ->add('serialNumber', TextType::class, array (
                'label'=>'N° de série',
            ))
            ->add('color', TextType::class, array (
                'label'=>'Couleur',
            ))
            ->add('numberplate', TextType::class, array (
                'label'=>'N° de plaque d\'immatriculation',
            ))
            ->add('kmNumber', TextType::class, array (
                'label'=>'Nombre de Km',
            ))
            ->add('purchaseDate', DateType::class, array (
                'label'=>'Date de première mise en circulation',
            ))
            ->add('availabilityDate', DateTimeType::class, array (
                'label'=>'Diponible le',
            ))
            ->add('agency', EntityType::class, array(
                'class'    => 'EmotionBundle:Agency',
                'choice_label' => 'agency',
                'label' => 'Lieu de l\'agence de la voiture',
                'multiple' => false))
            ->add('description', TextareaType::class)
            ->add('price', NumberType::class, array (
                'label'=>'Prix',
            ))
            ->add('price_buy', NumberType::class, array (
                'label'=>'Prix D\'achat du véhicule',
            ))
            ->add('imageFile', FileType::class, array (
                'label'=>'Photo du véhicule',
            ))
            ->add('save', SubmitType::class, array (
                'label'=>'Enregistrer',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmotionBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'emotionbundle_product';
    }


}