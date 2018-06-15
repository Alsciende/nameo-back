<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *     name="cards",
 *     uniqueConstraints={@ORM\UniqueConstraint(columns={"title"})},
 *     indexes={@ORM\Index(name="idx_card_difficulty",columns={"difficulty"})}
 *     )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Card
{
    const MAX_DIFFICULTY = 5;

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
     * @var string
     *
     * @ORM\Column(type="string",length=50,nullable=false)
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"match"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string",nullable=true)
     */
    private $link;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer",nullable=true)
     */
    private $difficulty;

    /**
     * Card constructor.
     *
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param Card $card
     *
     * @return bool
     */
    public function isEqualTo(Card $card)
    {
        return $this->id === $card->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param null|string $link
     *
     * @return $this
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return int
     */
    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    /**
     * @param int $difficulty
     *
     * @return $this
     */
    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
