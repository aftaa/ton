<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class OrderType extends AbstractType
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ShipCountry')
            ->add('ShipCity')
            ->add('ShipPostalcode')
            ->add('ShipAddress')
            ->add('ShipDate')
            ->add('Comments')
            ->add('ShipMetro')
            ->add('order', SubmitType::class, [
                'label' => $this->translator->trans('Оформить заказ'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
