<?php

declare(strict_types=1);

namespace App\Form\DataTransformer;

use App\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CardToIdTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Card|null $match
     *
     * @return string
     */
    public function transform($match)
    {
        if ($match instanceof Card) {
            return $match->getId();
        }

        return '';
    }

    /**
     * @param string $id
     *
     * @return Card|null
     *
     * @throws TransformationFailedException
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $match = $this->entityManager->find(Card::class, $id);

        if ($match instanceof Card) {
            return $match;
        }

        throw new TransformationFailedException('No match found with id ' . $id);
    }
}
