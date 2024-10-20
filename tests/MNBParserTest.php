<?php

use PHPUnit\Framework\TestCase;
use VSZ\MNB\MNBParser;

class MNBParserTest extends TestCase
{
    private MNBParser $mnbParser;

    protected function setUp(): void
    {
        $this->mnbParser = new MNBParser();
    }

    public function testParseExchangeRates(): void
    {
        $exchangeRatesData = '<MNBCurrentExchangeRates><Day><Rate unit="2" curr="TEST">200</Rate></Day></MNBCurrentExchangeRates>';

        $result = $this->mnbParser->parseExchangeRates($exchangeRatesData);

        $this->assertInstanceOf(\SimpleXMLElement::class, $result);
    }

    public function testParseExchangeRatesWithInvalidData(): void
    {
        $this->expectExceptionMessage('Unable to parse exchange rates!');

        $this->mnbParser->parseExchangeRates('<test>');
    }

    public function testParseExchangeRatesWithEmptyData(): void
    {
        $this->expectExceptionMessage('Unable to parse exchange rates!');

        $this->mnbParser->parseExchangeRates('');
    }
}
