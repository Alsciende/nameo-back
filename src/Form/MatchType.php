<?php

declare(strict_types=1);

namespace App\Form;

use App\Util\DateTimeNormalizer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_cards', IntegerType::class)
            ->add('difficulty', IntegerType::class)
            ->add('nb_players', IntegerType::class)
            ->add('nb_teams', IntegerType::class)
            ->add('started_at', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => false,
                'model_timezone' => 'UTC',
            ])
            ->add('started_date', TextType::class)
            ->add('started_time', TextType::class)
            ->add('started_tz', TextType::class)
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                function (FormEvent $event) {
                    $data = $event->getData();

                    $startedAt = DateTimeNormalizer::create($data['started_at']);
                    $data['started_date'] = DateTimeNormalizer::date($startedAt);
                    $data['started_time'] = DateTimeNormalizer::time($startedAt);
                    $data['started_tz'] = DateTimeNormalizer::tz($startedAt);

                    $event->setData($data);
                }
            );
    }
}
