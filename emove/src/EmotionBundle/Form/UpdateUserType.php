<?php
namespace EmotionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UpdateUserType extends AbstractType
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
            ->remove('loyaltyPoints')
            ->remove('username')
            ->add('save', SubmitType::class);
    }
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}