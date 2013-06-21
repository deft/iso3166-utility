<?php

namespace Deft\ISO3166;

use Deft\ISO3166\Exception\CountryCodeNotFoundException;
use Deft\ISO3166\Exception\ResourceFileNotFoundException;

class CountryCodeUtility
{
    /**
     * Dictionary for finding alpha-3 codes for alpha-2 codes
     * @var array
     */
    protected $alpha2To3Map = [];

    /**
     * Dictionary for finding alpha-2 codes for alpha-3 codes
     * @var array
     */
    protected $alpha3To2Map = [];

    public function __construct($dataPath = null)
    {
        $dataPath = $dataPath ?: __DIR__ . "/Resources/country_codes.txt";
        $this->parseCountryList($dataPath);
    }

    /**
     * @param $code
     * @return string
     * @throws
     */
    public function convertAlpha2ToAlpha3($code)
    {
        return isset($this->alpha2To3Map[$code]) ? $this->alpha2To3Map[$code] : null;
    }

    public function convertAlpha3ToAlpha2($code)
    {
        return isset($this->alpha3To2Map[$code]) ? $this->alpha3To2Map[$code] : null;
    }

    private function parseCountryList($filePath)
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new ResourceFileNotFoundException("File {$filePath} not found or not readable");
        }

        $fh = fopen($filePath, 'r');
        while ($row = fgetcsv($fh, null, "\t"))
        {
            if (count($row) != 2) continue;

            $this->alpha2To3Map[$row[0]] = $row[1];
            $this->alpha3To2Map[$row[1]] = $row[0];
        }
    }
}
