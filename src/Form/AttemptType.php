<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\DataTransformer\MatchToIdTransformer;
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
    /**
     * @var MatchToIdTransformer
     */
    private $matchToIdTransformer;

    /**
     * AttemptType constructor.
     *
     * @param MatchToIdTransformer $matchToIdTransformer
     */
    public function __construct(MatchToIdTransformer $matchToIdTransformer)
    {
        $this->matchToIdTransformer = $matchToIdTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('match', TextType::class, [
                'invalid_message' => 'That is not a valid match id',
            ])
            ->add('step', IntegerType::class)
            ->add('card', TextType::class)
            ->add('presented_at', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => false,
                'model_timezone' => 'UTC',
            ])
            ->add('presented_for', IntegerType::class)
            ->add('outcome', IntegerType::class)
        ;

        $builder
            ->get('match')->addModelTransformer($this->matchToIdTransformer);
    }
}
