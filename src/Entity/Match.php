<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="matches")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Match
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string",length=36)
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"match"})
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     */
    private $nbCards = 40;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0",max="5")
     */
    private $difficulty = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="4")
     */
    private $nbPlayers = 4;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\Range(min="2")
     */
    private $nbTeams = 2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotBlank()
     */
    private $startedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=10)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="10",max="10")
     */
    private $startedDate = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=8)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="8",max="8")
     */
    private $startedTime = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=6)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="6",max="6")
     */
    private $startedTz = '';

    /**
     * @var ArrayCollection
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"match"})
     */
    private $cards;

    public function __construct()
    {
        $this->startedAt = new \DateTime();
        $this->cards = new ArrayCollection();
    }

    public function getNbCards(): int
    {
        return $this->nbCards;
    }

    public function setNbCards(int $nbCards): self
    {
        $this->nbCards = $nbCards;

        return $this;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getNbPlayers(): int
    {
        return $this->nbPlayers;
    }

    public function setNbPlayers(int $nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    public function getNbTeams(): int
    {
        return $this->nbTeams;
    }

    public function setNbTeams(int $nbTeams): self
    {
        $this->nbTeams = $nbTeams;

        return $this;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
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

    public function getStartedDate(): string
    {
        return $this->startedDate;
    }

    public function setStartedDate(string $startedDate): self
    {
        $this->startedDate = $startedDate;

        return $this;
    }

    public function getStartedTime(): string
    {
        return $this->startedTime;
    }

    public function setStartedTime(string $startedTime): self
    {
        $this->startedTime = $startedTime;

        return $this;
    }

    public function getStartedTz(): string
    {
        return $this->startedTz;
    }

    public function setStartedTz(string $startedTz): self
    {
        $this->startedTz = $startedTz;

        return $this;
    }
}
