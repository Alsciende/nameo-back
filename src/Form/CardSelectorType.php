<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\DataTransformer\CardToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardSelectorType extends AbstractType
{
    private $transformer;

    public function __construct(CardToIdTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'The selected game does not exist',
        ]);
    }

    public function getParent()
    {
        return TextType::class;
    }
}
