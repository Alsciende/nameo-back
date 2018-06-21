<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="games")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Game
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string",length=36)
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"game"})
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbCards;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbPlayers;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbTeams;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $startedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=10)
     */
    private $startedDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=8)
     */
    private $startedTime;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=6)
     */
    private $startedTz;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"game"})
     */
    private $cards;

    public function __construct(int $nbCards, int $difficulty, int $nbPlayers, int $nbTeams, string $startedAt)
    {
        $this->nbCards = $nbCards;
        $this->difficulty = $difficulty;
        $this->nbPlayers = $nbPlayers;
        $this->nbTeams = $nbTeams;

        $this->startedAt = new \DateTime($startedAt);
        $this->startedDate = $this->startedAt->format('Y-m-d');
        $this->startedTime = $this->startedAt->format('H:i:s');
        $this->startedTz = $this->startedAt->getTimezone()->getName();

        $this->cards = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getNbCards(): int
    {
        return $this->nbCards;
    }

    /**
     * @return int
     */
    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    /**
     * @return int
     */
    public function getNbPlayers(): int
    {
        return $this->nbPlayers;
    }

    /**
     * @return int
     */
    public function getNbTeams(): int
    {
        return $this->nbTeams;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @return array
     */
    public function getCards(): array
    {
        return $this->cards->toArray();
    }

    /**
     * @param array $cards
     *
     * @return $this
     */
    public function setCards(iterable $cards): self
    {
        $this->clearCards();
        foreach ($cards as $card) {
            $this->addCard($card);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clearCards(): self
    {
        $this->cards->clear();

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function addCard(Card $card): self
    {
        if (false === $this->cards->contains($card)) {
            $this->cards->add($card);
        }

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function removeCard(Card $card): self
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStartedDate(): string
    {
        return $this->startedDate;
    }

    /**
     * @return string
     */
    public function getStartedTime(): string
    {
        return $this->startedTime;
    }

    /**
     * @return string
     */
    public function getStartedTz(): string
    {
        return $this->startedTz;
    }
}
