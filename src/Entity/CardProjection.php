<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="card_projections")
 */
class CardProjection
{
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

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbMatches;

    public function __construct(Card $card)
    {
        $this->card = $card;
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
     * @return self
     */
    public function setPresentedForSum(int $presentedForSum): self
    {
        $this->presentedForSum = $presentedForSum;

        return $this;
    }

    /**
     * @return int
     */
    public function getNbMatches(): int
    {
        return $this->nbMatches;
    }

    /**
     * @param int $nbMatches
     *
     * @return self
     */
    public function setNbMatches(int $nbMatches): self
    {
        $this->nbMatches = $nbMatches;

        return $this;
    }
}
