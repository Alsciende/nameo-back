<?php

namespace App\Tests\Form\DataTransformer;

use App\Entity\Card;
use App\Form\DataTransformer\CardToIdTransformer;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CardToIdTransformerTest extends TestCase
{
    /**
     * @var Card
     */
    private $game;

    /**
     * @var CardToIdTransformer
     */
    private $out;

    public function setUp()
    {
        parent::setUp();

        $this->game = $this->createMock(Card::class);
        $this->game->method('getId')->willReturn('fu');

        $map = [
            [Card::class, 'fu', $this->game],
        ];
        $em = $this->createMock(EntityManagerInterface::class);
        $em->method('find')->with($this->equalTo(Card::class))->will($this->returnValueMap($map));

        $this->out = new CardToIdTransformer($em);
    }

    public function testReverseTransform()
    {
        $this->assertEquals($this->game, $this->out->reverseTransform('fu'));
    }

    public function testReverseTransformEmpty()
    {
        $this->assertEquals(null, $this->out->reverseTransform(''));
    }

    public function testReverseTransformException()
    {
        $this->expectException(TransformationFailedException::class);
        $this->out->reverseTransform('bar');
    }

    public function testTransform()
    {
        $this->assertEquals('fu', $this->out->transform($this->game));
    }

    public function testTransformEmpty()
    {
        $this->assertEquals('', $this->out->transform(null));
    }
}
