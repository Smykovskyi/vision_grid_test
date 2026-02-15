<?php

namespace App\Tests\Service;

use App\Service\TransCompanyCalculation;
use PHPUnit\Framework\TestCase;

class TransCompanyCalculationTest extends TestCase
{
    public function testCalculate(): void
    {
        $transCompany = new TransCompanyCalculation();

        $this->assertEquals(20, $transCompany->calculate(1));
        $this->assertSame(20, $transCompany->calculate(7));
        $this->assertSame(20, $transCompany->calculate(9.99));
        $this->assertSame(20, $transCompany->calculate(10));
        $this->assertSame(100, $transCompany->calculate(11));
        $this->assertSame(100, $transCompany->calculate(120));
    }
}
