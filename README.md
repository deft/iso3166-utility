# iso3166-utility

Library to convert ISO3166 alpha-2 country codes to their alpha-3 counterpart and vice versa.

## Usage

```php
<?php

$util = new Deft\ISO3166\CountryCodeUtility();
print $util->convertAlpha2ToAlpha3('NLD'); // Outputs 'NL'
print $util->convertAlpha3ToAlpha2('NL'); // Outputs 'NLD';

// Converting non-existing country codes will result in null
$util->convertAlpha3ToAlpha2('FOO'); // Returns null

// You can provide a custom country code list by passing the path as the first
// constructor argument. The file should be tab separated ("NL\tNLD\n")
$utilCustom = new Deft\ISO3166\CountryCodeUtility('custom_country_code_list.txt');
```
