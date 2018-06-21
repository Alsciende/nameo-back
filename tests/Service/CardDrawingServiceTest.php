<?php

namespace App\Tests\Service;

use App\Distribution\DistributionInterface;
use App\Entity\Card;
use App\Entity\Game;
use App\Exception\NotEnoughCardsException;
use App\Repository\CardRepository;
use App\Service\CardDrawingService;
use App\Service\CardSortingService;
use PHPUnit\Framework\TestCase;

class CardDrawingServiceTest extends TestCase
{
    /**
     * @var Card
     */
    private $card;

    /**
     * @var Game
     */
    private $game;

    /**
     * @var CardRepository
     */
    private $repository;

    /**
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        $this->card = new Card('test');

        $this->game = new Game(1, 0, 4, 2, '2017-07-14T02:40:00+00:00');

        $this->repository = $this->createMock(CardRepository::class);
    }

    /**
     * @throws \ReflectionException
     */
    public function testDraw()
    {
        $classUnderTest = new CardDrawingService($this->repository);
        $classUnderTest->drawCardsFromPool($this->game, 1, [$this->card]);
        $this->assertEquals([$this->card], $this->game->getCards());
    }
}
