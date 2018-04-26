<?php

namespace App\Tests\Form\DataTransformer;

use App\Entity\Match;
use App\Form\DataTransformer\MatchToIdTransformer;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MatchToIdTransformerTest extends TestCase
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @var MatchToIdTransformer
     */
    private $out;

    public function setUp()
    {
        parent::setUp();

        $this->match = $this->createMock(Match::class);
        $this->match->method('getId')->willReturn('fu');

        $map = [
            [Match::class, 'fu', $this->match]
        ];
        $em = $this->createMock(EntityManagerInterface::class);
        $em->method('find')->with($this->equalTo(Match::class))->will($this->returnValueMap($map));

        $this->out = new MatchToIdTransformer($em);
    }

    public function testReverseTransform()
    {
        $this->assertEquals($this->match, $this->out->reverseTransform('fu'));
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
        $this->assertEquals('fu', $this->out->transform($this->match));
    }

    public function testTransformEmpty()
    {
        $this->assertEquals('', $this->out->transform(null));
    }
}
