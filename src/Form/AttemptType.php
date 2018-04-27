<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Model\CreateAttemptModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of AttemptType
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class AttemptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('match', MatchSelectorType::class)
            ->add('step', IntegerType::class)
            ->add('card', CardSelectorType::class)
            ->add('presented_at', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => false,
                'model_timezone' => 'UTC',
            ])
            ->add('presented_for', IntegerType::class)
            ->add('outcome', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateAttemptModel::class,
        ]);
    }
}
