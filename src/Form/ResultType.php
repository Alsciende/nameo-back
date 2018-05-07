<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Model\CreateResultModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ResultType
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class ResultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attempts', CollectionType::class, [
                'entry_type' => AttemptType::class,
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateResultModel::class,
        ]);
    }
}
