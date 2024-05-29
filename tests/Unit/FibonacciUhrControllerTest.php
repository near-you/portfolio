<?php

namespace Tests\Unit;

use App\Http\Controllers\FibonacciUhrController;
use Tests\TestCase;

class FibonacciUhrControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testGetCurrentTime()
    {
        $controller = new FibonacciUhrController();
        $currentTime = $controller->getCurrentTime();

        $this->assertIsArray($currentTime);
        $this->assertArrayHasKey('hours', $currentTime);
        $this->assertArrayHasKey('minutes', $currentTime);
        $this->assertIsInt($currentTime['hours']);
        $this->assertIsFloat($currentTime['minutes']);
        $this->assertGreaterThanOrEqual(1, $currentTime['hours']);
        $this->assertLessThanOrEqual(12, $currentTime['hours']);
        $this->assertGreaterThanOrEqual(0, $currentTime['minutes']);
        $this->assertLessThanOrEqual(55, $currentTime['minutes']);
    }

    /**
     *
     * @return void
     */
    public function testGetFibonacciRepresentation()
    {
        $controller = new FibonacciUhrController();

        $representation = $controller->getFibonacciRepresentation(1, 0);
//        $this->assertCount(5, $representation);
        $this->assertArrayHasKey(1, $representation);
        $this->assertArrayHasKey(2, $representation);
        $this->assertArrayHasKey(3, $representation);
        $this->assertArrayHasKey(5, $representation);
    }
}
