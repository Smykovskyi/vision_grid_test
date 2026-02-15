<?php

namespace App\Service;

class PackGroupCalculation implements CalculationInterface
{

    public function calculate(int $weight): int
    {
        return (int)$weight * 1;
    }
}
