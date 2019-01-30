<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Dish;

class DishesByCategoryType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dishes = $this->em->getRepository('AppBundle:Dish')->findBy([
            'category' => $options['category']
        ]);
        
        foreach ($dishes as $dish) {
            $builder
                ->add($dish->getId(), Type\IntegerType::class, [
                    'label' => $dish->getName(),
                    'required' => false,
                    'data' => 0,
                ])
            ;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'category',
            ])
            ->setAllowedTypes('category', ['string'])
            ->setAllowedValues('category', [Dish::CATEGORY_ENTREES, Dish::CATEGORY_DISHES, Dish::CATEGORY_DESSERTS])
        ;
    }
}
