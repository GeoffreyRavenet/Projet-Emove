<?php
namespace EmotionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('name')
            ->add('birthdate')
            ->add('zipCode')
            ->add('city')
            ->add('address')
            ->add('country')
            ->add('phone')
            ->add('driverLicence')
            ->add('loyaltyPoints', HiddenType::class, array(
                    'data' => '0',
                ))
            ->remove('username');
    }
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}