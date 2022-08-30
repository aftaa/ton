<?php

namespace App\Form;

use App\Entity\Order;
use App\Form\EventListener\ClearCartListener;
use App\Form\EventListener\RemoveCartItemListener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class CartType extends AbstractType
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('details', CollectionType::class, [
                'entry_type' => CartDetailType::class,
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->translator->trans('Сохранить'),
            ])
            ->add('clear', SubmitType::class, [
                'label' => $this->translator->trans('Очистить'),
            ]);
        $builder->addEventSubscriber(new RemoveCartItemListener($this->entityManager));
        $builder->addEventSubscriber(new ClearCartListener($this->entityManager));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
