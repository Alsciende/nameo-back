<?php

namespace App\Tests\Service;

use App\Distribution\DistributionInterface;
use App\Entity\Card;
use App\Entity\Match;
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
     * @var Match
     */
    private $match;

    /**
     * @var CardRepository
     */
    private $repository;

    /**
     * @var CardSortingService
     */
    private $sorting;

    /**
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        $this->card = new Card('test');

        $this->match = new Match(1, 0, 4, 2, '2017-07-14T02:40:00+00:00');

        $this->repository = $this->createMock(CardRepository::class);
        $this->repository->method('findAll')->willReturn([$this->card]);

        $this->sorting = $this->createMock(CardSortingService::class);
        $this->sorting->method('sortCardsByDifficulty')->willReturn([[$this->card], []]);
    }

    /**
     * @param int $value
     * @return DistributionInterface|\PHPUnit\Framework\MockObject\MockObject
     * @throws \ReflectionException
     */
    private function getProviderReturningValue(int $value)
    {
        $mock = $this->createMock(DistributionInterface::class);
        $mock->method('boundedAndCentered')->willReturn([$value]);

        return $mock;
    }

    /**
     * @throws \ReflectionException
     */
    public function testDraw()
    {
        $classUnderTest = new CardDrawingService($this->getProviderReturningValue(0), $this->repository, $this->sorting);
        $classUnderTest->drawCards($this->match);
        $this->assertEquals([$this->card], $this->match->getCards());
    }

    /**
     * @throws \ReflectionException
     */
    public function testDrawException()
    {
        $classUnderTest = new CardDrawingService($this->getProviderReturningValue(1), $this->repository, $this->sorting);
        $this->expectException(NotEnoughCardsException::class);
        $classUnderTest->drawCards($this->match);
    }
}
