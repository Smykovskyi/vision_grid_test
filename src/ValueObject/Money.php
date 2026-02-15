<?php

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class Money
{
    public function __construct(
        #[ORM\Column(name: "amount", type: "integer", nullable: false)]
        private int $amount,
        #[ORM\Column(name: "currency_code", type: "string", length: 3, nullable: false)]
        private string $currencyCode,
    ) {
    }

    public function getAmountInMinorUnits(): int
    {
        return $this->amount;
    }

    public function getAmountInMajorUnits(int $precision = 2): float
    {
        return $this->amount / (10 ** $precision);
    }
}
