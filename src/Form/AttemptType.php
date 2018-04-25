<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ->add('step', IntegerType::class)
            ->add('card', TextType::class)
            ->add('presented_at', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => DateTimeType::HTML5_FORMAT,
                'input' => 'datetime',
                'model_timezone' => 'UTC',
            ])
            ->add('presented_for', IntegerType::class)
            ->add('outcome', IntegerType::class)
        ;
    }
}
