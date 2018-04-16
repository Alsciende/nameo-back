<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_cards', IntegerType::class)
            ->add('difficulty', IntegerType::class)
            ->add('nb_players', IntegerType::class)
            ->add('nb_teams', IntegerType::class)
            ->add('start_at', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => DateTimeType::HTML5_FORMAT,
                'input' => 'datetime',
                'model_timezone' => 'UTC',
            ])
        ;
    }
}
