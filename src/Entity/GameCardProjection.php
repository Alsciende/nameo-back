<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="game_card_projections")
 */
class GameCardProjection
{
    /**
     * @var Game
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", nullable=false)
     */
    private $game;

    /**
     * @var Card
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     */
    private $card;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $presentedForSum;

    public function __construct(Game $game, Card $card)
    {
        $this->game = $game;
        $this->card = $card;
        $this->presentedForSum = 0;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @return int
     */
    public function getPresentedForSum(): int
    {
        return $this->presentedForSum;
    }

    /**
     * @param int $presentedForSum
     *
     * @return $this
     */
    public function setPresentedForSum(int $presentedForSum): self
    {
        $this->presentedForSum = $presentedForSum;

        return $this;
    }

    /**
     * @param Attempt $attempt
     *
     * @return $this
     */
    public function update(Attempt $attempt): self
    {
        if (false === $this->card->isEqualTo($attempt->getCard())) {
            throw new \LogicException('Trying to combine data from different cards.');
        }

        $this->presentedForSum += $attempt->getPresentedFor();

        return $this;
    }
}
