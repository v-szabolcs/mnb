<?php

use PHPUnit\Framework\TestCase;
use VSZ\MNB\MNBService;

class MNBServiceTest extends TestCase
{
    private MNBService $mnbService;

    protected function setUp(): void
    {
        $soapClientMock = new class extends \SoapClient
        {
            public string $GetCurrentExchangeRatesResult = '<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>';

            public function __construct() {}

            public function GetCurrentExchangeRates(): self
            {
                return $this;
            }
        };

        $this->mnbService = new MNBService($soapClientMock);
    }

    public function testFetchExchangeRates(): void
    {
        $result = $this->mnbService->fetchExchangeRates();

        $this->assertSame('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>', $result);
    }
}
