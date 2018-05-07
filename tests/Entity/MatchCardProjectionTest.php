<?php

namespace App\Tests\Entity;

use App\Entity\Attempt;
use App\Entity\Card;
use App\Entity\Match;
use App\Entity\MatchCardProjection;
use PHPUnit\Framework\TestCase;

class MatchCardProjectionTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testUpdate()
    {
        $match = $this->createMock(Match::class);
        $card = $this->createMock(Card::class);
        $card->method('getId')->willReturn('fu');
        $attempt = $this->createMock(Attempt::class);
        $attempt->method('getCard')->willReturn($card);
        $attempt->method('getPresentedFor')->willReturn(11);
        $projection = new MatchCardProjection($match, $card);
        $projection->update($attempt);
        $this->assertEquals(11, $projection->getPresentedForSum());
        $projection->update($attempt);
        $this->assertEquals(22, $projection->getPresentedForSum());
    }
}
