<?php

namespace App\Tests\Service;

use App\Entity\Attempt;
use App\Entity\Card;
use App\Entity\Match;
use App\Entity\MatchCardProjection;
use App\Repository\AttemptRepository;
use App\Repository\CardProjectionRepository;
use App\Service\ProjectionService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class ProjectionServiceTest extends TestCase
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AttemptRepository
     */
    private $attemptRepository;

    /**
     * @var CardProjectionRepository
     */
    private $cardProjectionRepository;

    /**
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        $this->match = $this->createMock(Match::class);

        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        $this->attemptRepository = $this->createMock(AttemptRepository::class);

        $this->cardProjectionRepository = $this->createMock(CardProjectionRepository::class);
    }

    /**
     * @param Match $match
     * @param Card  $card
     * @param int   $presentedFor
     * @return Attempt|\PHPUnit\Framework\MockObject\MockObject
     * @throws \ReflectionException
     */
    private function mockAttempt(Match $match, Card $card, int $presentedFor)
    {
        $attempt = $this->createMock(Attempt::class);
        $attempt->method('getMatch')->willReturn($match);
        $attempt->method('getCard')->willReturn($card);
        $attempt->method('getPresentedFor')->willReturn($presentedFor);

        return $attempt;
    }

    /**
     * @throws \ReflectionException
     */
    public function testCompileAttempts()
    {
        $card = $this->createMock(Card::class);
        $card->method('getId')->willReturn('fu');
        $attempts = [
            $this->mockAttempt($this->match, $card, 11),
            $this->mockAttempt($this->match, $card, 6)
        ];

        $object = new ProjectionService($this->entityManager, $this->attemptRepository, $this->cardProjectionRepository);
        $projections = $object->compileAttempts($attempts);

        $objectToCompare = new MatchCardProjection($this->match, $card);
        $objectToCompare->setPresentedForSum(17);
        $this->assertEquals(['fu' => $objectToCompare], $projections);
    }

    /**
     * @throws \ReflectionException
     */
    public function testApplyOrderToDifficulty()
    {
        $cardA = $this->createMock(Card::class);
        $cardA->method('getId')->willReturn('fu');
        $cardA->expects($this->once())->method('setDifficulty')->with(3);

        $cardB = $this->createMock(Card::class);
        $cardB->method('getId')->willReturn('bar');
        $cardB->expects($this->once())->method('setDifficulty')->with(0);

        $cardC = $this->createMock(Card::class);
        $cardC->method('getId')->willReturn('baz');
        $cardC->expects($this->once())->method('setDifficulty')->with(1);

        $object = new ProjectionService($this->entityManager, $this->attemptRepository, $this->cardProjectionRepository);
        $object->applyOrderToDifficulty([$cardB, $cardC, $cardA]);
    }
}
