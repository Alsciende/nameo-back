<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Model\CreateGameModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_cards', IntegerType::class)
            ->add('difficulty', IntegerType::class)
            ->add('nb_players', IntegerType::class)
            ->add('nb_teams', IntegerType::class)
            ->add('started_at', TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateGameModel::class,
        ]);
    }
}
