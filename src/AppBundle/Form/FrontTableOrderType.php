<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use AppBundle\Entity\Dish;

class FrontTableOrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(Dish::CATEGORY_ENTREES, DishesByCategoryType::class, [
                'label' => 'Entrées',
                'category' => Dish::CATEGORY_ENTREES,
            ])
            ->add(Dish::CATEGORY_DISHES, DishesByCategoryType::class, [
                'label' => 'Plats',
                'category' => Dish::CATEGORY_DISHES,
            ])
            ->add(Dish::CATEGORY_DESSERTS, DishesByCategoryType::class, [
                'label' => 'Desserts',
                'category' => Dish::CATEGORY_DESSERTS,
            ])
        ;
    }
}
