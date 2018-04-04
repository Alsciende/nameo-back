<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Card
 *
 * @ORM\Entity()
 * @ORM\Table(name="cards",uniqueConstraints={@ORM\UniqueConstraint(name="title_idx", columns={"title"})})
 */
class Card
{
    const MAX_DIFFICULTY = 5;

    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="id",nullable=false,type="string",length=36)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title",nullable=false,type="string",length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="50")
     */
    protected $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link",nullable=true,type="string")
     */
    protected $link;

    /**
     * @var int
     *
     * @ORM\Column(name="difficulty",nullable=false,type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0",max="5")
     */
    protected $difficulty;

    /**
     * Card constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
        $this->difficulty = 0;
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


}
