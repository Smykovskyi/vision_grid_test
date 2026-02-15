<?php

namespace App\Tests\Service;

use App\Service\PackGroupCalculation;
use PHPUnit\Framework\TestCase;

class PackGroupCalculationTest extends TestCase
{
    public function testCalculate(): void
    {
        $packGroup = new PackGroupCalculation();

        $this->assertSame(0, $packGroup->calculate(0));
        $this->assertSame(1, $packGroup->calculate(1));
        $this->assertSame(12, $packGroup->calculate(12));
        $this->assertSame(53, $packGroup->calculate(53));
    }
}
