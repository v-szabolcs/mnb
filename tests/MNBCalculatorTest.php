<?php

use PHPUnit\Framework\TestCase;
use VSZ\MNB\MNBCalculator;

class MNBCalculatorTest extends TestCase
{
    private MNBCalculator $mnbCalculator;

    protected function setUp(): void
    {
        $this->mnbCalculator = new MNBCalculator();
    }

    public function testCalculateExchangeRate(): void
    {
        $result = $this->mnbCalculator->calculateExchangeRate(2, 200);

        $this->assertIsFloat($result);
        $this->assertSame(100.00, $result);
    }

    public function testCalculateExchangeRateWithInvalidUnit(): void
    {
        $this->expectExceptionMessage('Unable to calculate exchange rate!');

        $this->mnbCalculator->calculateExchangeRate(0, 200);
    }
}
