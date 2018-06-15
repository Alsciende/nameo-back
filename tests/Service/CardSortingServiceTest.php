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
            (new Card('a'))->setDifficulty(0),
            (new Card('b'))->setDifficulty(0),
            (new Card('c'))->setDifficulty(2),
            (new Card('d'))->setDifficulty(1)
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
