<?php

namespace VSZ\MNB;

class MNBValidator
{
    public function validateExchangeRate(int $unit, float $value): void
    {
        if (filter_var($unit, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) === false) {
            throw new \Exception('Invalid exchange rate unit!');
        }

        if (filter_var($value, FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0.0001]]) === false) {
            throw new \Exception('Invalid exchange rate value!');
        }
    }
}
