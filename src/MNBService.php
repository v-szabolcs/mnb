<?php

namespace VSZ\MNB;

class MNBService
{
    public function __construct(
        private \SoapClient $soapClient,
    ) {}

    public function fetchExchangeRates(): string
    {
        try {
            $result = $this->soapClient->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult;
        } catch (\SoapFault) {
            throw new \Exception('Unable to fetch exchange rates!');
        }

        return $result;
    }
}
