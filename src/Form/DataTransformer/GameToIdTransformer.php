<?php

declare(strict_types=1);

namespace App\Form\DataTransformer;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class GameToIdTransformer implements DataTransformerInterface
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
     * @param Game|null $game
     *
     * @return string
     */
    public function transform($game)
    {
        if ($game instanceof Game) {
            return $game->getId();
        }

        return '';
    }

    /**
     * @param string $id
     *
     * @return Game|null
     *
     * @throws TransformationFailedException
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $game = $this->entityManager->find(Game::class, $id);

        if ($game instanceof Game) {
            return $game;
        }

        throw new TransformationFailedException('No game found with id ' . $id);
    }
}
