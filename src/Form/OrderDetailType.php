<?php

namespace App\Form;

use App\Entity\OrderDetail;
use App\Repository\SizeRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class OrderDetailType extends AbstractType
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Quantity', )
            ->add('size')
            ->add('add', SubmitType::class, [
                'label' => $this->translator->trans('Добавить'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderDetail::class,
        ]);
    }
}
