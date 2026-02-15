<?php

namespace App\ValueObject;

use App\Service\CalculationInterface;
use App\Service\PackGroupCalculation;
use App\Service\TransCompanyCalculation;

enum Carrier: string
{
    case Transcompany = 'transcompany';
    case Packgroup = 'packgroup';

    public static function getCarrierCalculator(string $value): ?CalculationInterface
    {
        return match ($value) {
            self::Transcompany->value => new TransCompanyCalculation(),
            self::Packgroup->value => new PackGroupCalculation(),
            default => null,
        };
    }
}
