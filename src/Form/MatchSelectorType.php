<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\DataTransformer\MatchToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchSelectorType extends AbstractType
{
    private $transformer;

    public function __construct(MatchToIdTransformer $transformer)
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
            'invalid_message' => 'The selected match does not exist',
        ]);
    }

    public function getParent()
    {
        return TextType::class;
    }
}
