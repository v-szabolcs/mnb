<?php

use VSZ\MNB\MNBClient;
use VSZ\MNB\MNBParser;
use VSZ\MNB\MNBService;
use VSZ\MNB\MNBValidator;
use PHPUnit\Framework\TestCase;

class MNBClientTest extends TestCase
{
    public function testGetExchangeRate(): void
    {
        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $result = $mnbClient->getExchangeRate('TEST');

        $this->assertIsFloat($result);
        $this->assertSame(100.00, $result);
    }

    public function testGetExchangeRateWithInvalidCurrency(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('XYZ');
    }

    public function testGetExchangeRateWithEmptyCurrency(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('');
    }

    public function testGetExchangeRateWithEmptyResponseCurrency(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithoutResponseCurrency(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithInvalidResponseUnit(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate unit!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="0" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithEmptyResponseUnit(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate unit!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithoutResponseUnit(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithInvalidResponseValue(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate value!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">0</Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithoutResponseValue(): void
    {
        $this->expectExceptionMessage('Invalid exchange rate value!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST"></Rate></Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithoutResponseRateNode(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Day>200</Day></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithoutResponseDayNode(): void
    {
        $this->expectExceptionMessage('Unable to get exchange rate!');

        $soapClientMock = $this->createSoapClientMock('<MNBCurrentExchangeRates><Rate unit="2" curr="TEST">200</Rate></MNBCurrentExchangeRates>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithInvalidResponse(): void
    {
        $this->expectExceptionMessage('Unable to parse exchange rates!');

        $soapClientMock = $this->createSoapClientMock('<test>');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    public function testGetExchangeRateWithEmptyResponse(): void
    {
        $this->expectExceptionMessage('Unable to parse exchange rates!');

        $soapClientMock = $this->createSoapClientMock('');

        $mnbClient = new MNBClient(
            new MNBService($soapClientMock),
            new MNBParser(),
            new MNBValidator(),
        );

        $mnbClient->getExchangeRate('TEST');
    }

    private function createSoapClientMock(string $result): \SoapClient
    {
        return new class($result) extends \SoapClient
        {
            public string $GetCurrentExchangeRatesResult;

            public function __construct(string $result)
            {
                $this->GetCurrentExchangeRatesResult = $result;
            }

            public function GetCurrentExchangeRates(): self
            {
                return $this;
            }
        };
    }
}
