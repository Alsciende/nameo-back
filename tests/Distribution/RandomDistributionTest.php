<?php

namespace Tests\Distribution;

use App\Distribution\RandomDistribution;
use PHPUnit\Framework\TestCase;

class RandomDistributionTest extends TestCase
{
    /**
     * @var RandomDistribution
     */
    private $classUnderTest;

    public function setUp()
    {
        parent::setUp();
        $this->classUnderTest = new RandomDistribution();
    }

    public function testBoundedAndCentered()
    {
        $this->assertEquals([5], $this->classUnderTest->boundedAndCentered(5, 5, 5, 1));
        $this->assertGreaterThanOrEqual([0], $this->classUnderTest->boundedAndCentered(0, 10, 5, 1));
        $this->assertLessThanOrEqual([10], $this->classUnderTest->boundedAndCentered(0, 10, 5, 1));
    }
}
