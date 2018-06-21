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
     * @param Card|null $game
     *
     * @return string
     */
    public function transform($game)
    {
        if ($game instanceof Card) {
            return $game->getId();
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

        $game = $this->entityManager->find(Card::class, $id);

        if ($game instanceof Card) {
            return $game;
        }

        throw new TransformationFailedException('No game found with id ' . $id);
    }
}
