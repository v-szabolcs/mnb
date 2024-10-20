<?php

namespace VSZ\MNB;

class MNBCalculator
{
    public function calculateExchangeRate(int $unit, float $value): float
    {
        try {
            $result = $value / $unit;
        } catch (\Exception | \DivisionByZeroError) {
            throw new \Exception('Unable to calculate exchange rate!');
        }

        return $result;
    }
}
