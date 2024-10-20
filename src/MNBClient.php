<?php

namespace VSZ\MNB;

use VSZ\MNB\MNBParser;
use VSZ\MNB\MNBService;
use VSZ\MNB\MNBValidator;

class MNBClient
{
    public function __construct(
        private MNBService $mnbService,
        private MNBParser $mnbParser,
        private MNBValidator $mnbValidator,
    ) {}

    public function getExchangeRate(string $currency): float
    {
        $exchangeRatesData = $this->mnbService->fetchExchangeRates();

        $exchangeRatesXml = $this->mnbParser->parseExchangeRates($exchangeRatesData);

        $xpathQuery = '/MNBCurrentExchangeRates/Day/Rate[@unit][@curr="' . $currency . '"]';

        $xpath = $exchangeRatesXml->xpath($xpathQuery);

        if (count($xpath) === 0) {
            throw new \Exception('Unable to get exchange rate!');
        }

        $exchangeRateUnit = (int) $xpath[0]->attributes()->unit;
        $exchangeRateValue = (float) str_replace(',', '.', $xpath[0][0]);

        $this->mnbValidator->validateExchangeRate($exchangeRateUnit, $exchangeRateValue);

        try {
            $exchangeRate = $exchangeRateValue / $exchangeRateUnit;
        } catch (\DivisionByZeroError) {
            throw new \Exception('Unable to calculate exchange rate!');
        }

        return $exchangeRate;
    }
}
