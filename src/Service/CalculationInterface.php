<?php

namespace App\Service;

interface CalculationInterface
{
    public function calculate(int $weight): int;
}
