<?php

namespace VSZ\MNB;

class MNBParser
{
    public function parseExchangeRates(string $data): \SimpleXMLElement
    {
        $xml = simplexml_load_string($data, null, LIBXML_NOERROR);

        if ($xml === false) {
            throw new \Exception('Unable to parse exchange rates!');
        }

        return $xml;
    }
}
