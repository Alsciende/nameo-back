<?php

namespace App\Tests\Service;

use App\Entity\Card;
use App\Service\CardSortingService;
use PHPUnit\Framework\TestCase;

class CardSortingServiceTest extends TestCase
{
    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        $this->cards = [
            new Card('a', 0),
            new Card('b', 0),
            new Card('c', 2),
            new Card('d', 1)
        ];
    }

    /**
     * @throws \ReflectionException
     */
    public function testSort()
    {
        $classUnderTest = new CardSortingService();
        $this->assertEquals([
            [$this->cards[0], $this->cards[1]],
            [$this->cards[3]],
            [$this->cards[2]],
            [],
            [],
        ], $classUnderTest->sortCardsByDifficulty($this->cards));
    }
}
