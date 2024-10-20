<?php

use PHPUnit\Framework\TestCase;
use VSZ\MNB\MNBValidator;

class MNBValidatorTest extends TestCase
{
    private MNBValidator $mnbValidator;

    protected function setUp(): void
    {
        $this->mnbValidator = new MNBValidator();
    }

    public function testValidateExchangeRate(): void
    {
        $this->expectNotToPerformAssertions();

        $this->mnbValidator->validateExchangeRate(2, 200);
    }

    public function testValidateExchangeRateWithInvalidUnit(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate unit!');

        $this->mnbValidator->validateExchangeRate(0, 200);
    }

    public function testValidateExchangeRateWithInvalidValue(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate value!');

        $this->mnbValidator->validateExchangeRate(2, 0);
    }
}
