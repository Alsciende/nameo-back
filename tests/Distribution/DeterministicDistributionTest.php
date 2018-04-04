<?php

namespace Tests\Distribution;

use App\Distribution\DeterministicDistribution;
use PHPUnit\Framework\TestCase;

class DeterministicDistributionTest extends TestCase
{
    /**
     * @var DeterministicDistribution
     */
    private $classUnderTest;

    public function setUp()
    {
        parent::setUp();
        $this->classUnderTest = new DeterministicDistribution();
    }

    public function testBoundedAndCentered()
    {
        $this->assertEquals([5], $this->classUnderTest->boundedAndCentered(5, 5, 5, 1));
        $this->assertGreaterThanOrEqual([0], $this->classUnderTest->boundedAndCentered(0, 10, 5, 1));
        $this->assertLessThanOrEqual([10], $this->classUnderTest->boundedAndCentered(0, 10, 5, 1));

        $sample = $this->classUnderTest->boundedAndCentered(0, 9, 5, 10);
        $this->assertEquals([5,5,5,5,5,5,5,5,4,6], $sample);
    }
}
