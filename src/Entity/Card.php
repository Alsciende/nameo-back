<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cards",uniqueConstraints={@ORM\UniqueConstraint(columns={"title"})})
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
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
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
     * @var int
     *
     * @ORM\Column(type="integer",nullable=false)
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0",max="5")
     */
    private $difficulty;

    /**
     * Card constructor.
     *
     * @param string $title
     * @param int    $difficulty
     */
    public function __construct(string $title, int $difficulty = 0)
    {
        $this->title = $title;
        $this->difficulty = $difficulty;
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
     * @return self
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
     * @return self
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return int
     */
    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    /**
     * @param int $difficulty
     *
     * @return self
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
