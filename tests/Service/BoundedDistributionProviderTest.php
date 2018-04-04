<?php

namespace Tests\Service;

use App\Service\BoundedDistributionProvider;
use PHPUnit\Framework\TestCase;

class BoundedDistributionProviderTest extends TestCase
{
    /**
     * @var BoundedDistributionProvider
     */
    private $classUnderTest;

    public function setUp()
    {
        parent::setUp();
        $this->classUnderTest = new BoundedDistributionProvider();
    }

    public function testRand()
    {
        $this->assertEquals(5, $this->classUnderTest->rand(5, 5, 5));
        $this->assertGreaterThanOrEqual(0, $this->classUnderTest->rand(0, 10, 5));
        $this->assertLessThanOrEqual(10, $this->classUnderTest->rand(0, 10, 5));
    }
}
