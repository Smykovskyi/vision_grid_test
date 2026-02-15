<?php

namespace App\Service;

class TransCompanyCalculation implements CalculationInterface
{

    public function calculate(int $weight): int
    {
        if ($weight > 10) {
            return (int)100;
        }

        return (int)20;
    }
}
