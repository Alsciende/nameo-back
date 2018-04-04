<?php

namespace Tests\Manager;

use App\Distribution\DistributionInterface;
use App\Entity\Match;
use App\Exception\NotEnoughCardsException;
use App\Manager\MatchManager;
use App\Repository\CardRepository;
use App\Service\BoundedDistributionProvider;
use PHPUnit\Framework\TestCase;

class MatchManagerTest extends TestCase
{
    /**
     * @var Match
     */
    private $match;

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

        $this->match = $this->createMock(Match::class);
        $this->match->method('getQuantity')->willReturn(1);
        $this->match->method('getDifficulty')->willReturn(0);

        $this->repository = $this->createMock(CardRepository::class);
        $this->repository->method('getCardsByDecile')->willReturn([['a'], []]);
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
        $classUnderTest = new MatchManager($this->getProviderReturningValue(0), $this->repository);
        $this->assertEquals(['a'], $classUnderTest->draw($this->match));
    }

    /**
     * @throws \ReflectionException
     */
    public function testDrawException()
    {
        $classUnderTest = new MatchManager($this->getProviderReturningValue(1), $this->repository);
        $this->expectException(NotEnoughCardsException::class);
        $classUnderTest->draw($this->match);
    }
}
