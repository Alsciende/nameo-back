<?php

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateMatchModel
{
    /**
     * @var int|null
     *
     * @Assert\NotBlank()
     */
    private $nbCards = 40;

    /**
     * @var int|null
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0",max="5")
     */
    private $difficulty = 0;

    /**
     * @var int|null
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="4")
     */
    private $nbPlayers = 4;

    /**
     * @var int|null
     *
     * @Assert\Range(min="2")
     */
    private $nbTeams = 2;

    /**
     * @var \DateTime|null
     *
     * @Assert\NotBlank()
     */
    private $startedAt;

    /**
     * @var string|null
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="10",max="10")
     */
    private $startedDate = '';

    /**
     * @var string|null
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="8",max="8")
     */
    private $startedTime = '';

    /**
     * @var string|null
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="6",max="6")
     */
    private $startedTz = '';

    /**
     * @return int|null
     */
    public function getNbCards(): ?int
    {
        return $this->nbCards;
    }

    /**
     * @param int|null $nbCards
     *
     * @return self
     */
    public function setNbCards(?int $nbCards): self
    {
        $this->nbCards = $nbCards;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    /**
     * @param int|null $difficulty
     *
     * @return self
     */
    public function setDifficulty(?int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbPlayers(): ?int
    {
        return $this->nbPlayers;
    }

    /**
     * @param int|null $nbPlayers
     *
     * @return self
     */
    public function setNbPlayers(?int $nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbTeams(): ?int
    {
        return $this->nbTeams;
    }

    /**
     * @param int|null $nbTeams
     *
     * @return self
     */
    public function setNbTeams(?int $nbTeams): self
    {
        $this->nbTeams = $nbTeams;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime|null $startedAt
     *
     * @return self
     */
    public function setStartedAt(?\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStartedDate(): ?string
    {
        return $this->startedDate;
    }

    /**
     * @param null|string $startedDate
     *
     * @return self
     */
    public function setStartedDate(?string $startedDate): self
    {
        $this->startedDate = $startedDate;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStartedTime(): ?string
    {
        return $this->startedTime;
    }

    /**
     * @param null|string $startedTime
     *
     * @return self
     */
    public function setStartedTime(?string $startedTime): self
    {
        $this->startedTime = $startedTime;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStartedTz(): ?string
    {
        return $this->startedTz;
    }

    /**
     * @param null|string $startedTz
     *
     * @return self
     */
    public function setStartedTz(?string $startedTz): self
    {
        $this->startedTz = $startedTz;

        return $this;
    }
}
