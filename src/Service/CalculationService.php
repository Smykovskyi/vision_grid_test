<?php

namespace App\Service;

use App\ValueObject\Carrier;
use Symfony\Component\HttpFoundation\Request;

class CalculationService
{
    private string $carrier;
    private int $weight;

    public function calculate(): ?int
    {
        $carrierCalculator = Carrier::getCarrierCalculator($this->carrier);
        if(null === $carrierCalculator) {
            return null;
        }
        return $carrierCalculator->calculate($this->weight);
    }

    public function isValid(Request $request): bool
    {
        $data = $request->toArray();

        // Basic validation and sanitization
        if(
            array_key_exists('carrier', $data) && \is_string($data['carrier']) && \strlen($data['carrier']) > 0
            &&
            array_key_exists('weight', $data) && \is_numeric($data['weight']) && $data['weight'] >= 0
        ) {
            $this->carrier = trim(strip_tags($data['carrier']));
            $this->weight = filter_var($data['weight'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            return true;
        }

        return false;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }
}
