<?php

Class BitcoinCalc
{
    private function request($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Agent'
        ));

        return curl_exec($curl);

        curl_close($curl);
    }

    private function getBitcoin($crypto = 'BTC')
    {
        // Fetch the last price for the given crypto against EUR from cex.io
        $url = 'https://cex.io/api/ticker/' . strtoupper($crypto) . '/EUR';
        $raw  = $this->request($url);
        $data = json_decode($raw, true);

        if (isset($data['last']))
            return $data['last'];

        return null;
    }

    private function getCurrency()
    {
        global $config;

        $api_key = $config['api_key'];

        $url  = 'http://data.fixer.io/latest?base=EUR&access_key=' . $api_key;
        $raw  = $this->request($url);
        $data = json_decode($raw, true);

        return isset($data['rates']) ? $data['rates'] : array();
    }

    public function combine($crypto = 'BTC')
    {
        $bvalue = $this->getBitcoin($crypto);
        $cvalue = $this->getCurrency();

        $bitcoin = array();
        if ($bvalue === null) return false;

        foreach ($cvalue as $k => $v) {
            $value = $bvalue * $v;
            $bitcoin[$k] = $value;
        }

        // price in EUR for the selected crypto
        $bitcoin['EUR'] = $bvalue;

        return $bitcoin;
    }

    public static function code2name($code)
    {
            $carray = array(
        "AED" => "UAE Dirham",
        "AFN" => "Afghani",
        "ALL" => "Albanian Lek",
        "AMD" => "Armenian Dram",
        "ANG" => "Antillian Guilder",
        "AOA" => "Angolan Kwanza",
        "ARS" => "Argentine Peso",
        "AUD" => "Australian Dollar",
        "AWG" => "Aruban Guilder",
        "AZN" => "Azerbaijan Manat",
        "BAM" => "Bosnia Mark",
        "BBD" => "Barbadian Dollar",
        "BDT" => "Bangladeshi Taka",
        "BGN" => "Bulgarian Lev",
        "BHD" => "Bahraini Dinar",
        "BIF" => "Burundi Franc",
        "BMD" => "Bermudian Dollar",
        "BND" => "Brunei Dollar",
        "BOB" => "Boliviano",
        "BRL" => "Brazilian Real",
        "BSD" => "Bahamian Dollar",
        "BTN" => "Bhutan Ngultrum",
        "BWP" => "Botswana Pula",
        "BYN" => "Belarusian Ruble",
        "BZD" => "Belize Dollar",
        "CAD" => "Canadian Dollar",
        "CDF" => "Congolese Franc",
        "CHF" => "Swiss Franc",
        "CLF" => "Chile UF",
        "CLP" => "Chilean Peso",
        "CNY" => "Chinese Yuan",
        "COP" => "Colombian Peso",
        "CRC" => "Costa Rican Colon",
        "CUP" => "Cuban Peso",
        "CVE" => "Cape Verde Escudo",
        "CZK" => "Czech Koruna",
        "DJF" => "Djiboutian Franc",
        "DKK" => "Danish Krone",
        "DOP" => "Dominican Peso",
        "DZD" => "Algerian Dinar",
        "EGP" => "Egyptian Pound",
        "ERN" => "Eritrean Nakfa",
        "ETB" => "Ethiopian Birr",
        "EUR" => "Euro",
        "FJD" => "Fijian Dollar",
        "FKP" => "Falkland Islands Pound",
        "GBP" => "British Pound Sterling",
        "GEL" => "Georgian Lari",
        "GGP" => "Guernsey Pound",
        "GHS" => "Ghana Cedi",
        "GIP" => "Gibraltar Pound",
        "GMD" => "Gambian Dalasi",
        "GNF" => "Guinean Franc",
        "GTQ" => "Guatemalan Quetzal",
        "GYD" => "Guyanese Dollar",
        "HKD" => "Hong Kong Dollar",
        "HNL" => "Honduran Lempira",
        "HRK" => "Croatian Kuna",
        "HTG" => "Haitian Gourde",
        "HUF" => "Hungarian Forint",
        "IDR" => "Indonesian Rupiah",
        "ILS" => "Israeli Shekel",
        "IMP" => "Isle of Man Pound",
        "INR" => "Indian Rupee",
        "IQD" => "Iraqi Dinar",
        "IRR" => "Iranian Rial",
        "ISK" => "Iceland Krona",
        "JEP" => "Jersey Pound",
        "JMD" => "Jamaican Dollar",
        "JOD" => "Jordanian Dinar",
        "JPY" => "Japanese Yen",
        "KES" => "Kenyan Shilling",
        "KGS" => "Kyrgyzstani Som",
        "KHR" => "Cambodian Riel",
        "KMF" => "Comorian Franc",
        "KPW" => "North Korean Won",
        "KRW" => "South Korean Won",
        "KWD" => "Kuwaiti Dinar",
        "KYD" => "Cayman Islands Dollar",
        "KZT" => "Kazakhstani Tenge",
        "LAK" => "Laotian Kip",
        "LBP" => "Lebanese Pound",
        "LKR" => "Sri Lankan Rupee",
        "LRD" => "Liberian Dollar",
        "LSL" => "Lesotho Loti",
        "LTL" => "Lithuanian Litas",
        "LVL" => "Latvian Lats",
        "LYD" => "Libyan Dinar",
        "MAD" => "Moroccan Dirham",
        "MDL" => "Moldovan Leu",
        "MGA" => "Malagasy Ariary",
        "MKD" => "Macedonian Denar",
        "MMK" => "Myanmar Kyat",
        "MNT" => "Mongolian Tugrik",
        "MOP" => "Macanese Pataca",
        "MRU" => "Mauritanian Ouguiya",
        "MUR" => "Mauritian Rupee",
        "MVR" => "Maldivian Rufiyaa",
        "MWK" => "Malawian Kwacha",
        "MXN" => "Mexican Peso",
        "MYR" => "Malaysian Ringgit",
        "MZN" => "Mozambican Metical",
        "NAD" => "Namibian Dollar",
        "NGN" => "Nigerian Naira",
        "NIO" => "Nicaraguan Cordoba",
        "NOK" => "Norwegian Krone",
        "NPR" => "Nepalese Rupee",
        "NZD" => "New Zealand Dollar",
        "OMR" => "Omani Rial",
        "PAB" => "Panamanian Balboa",
        "PEN" => "Peruvian Sol",
        "PGK" => "Papua New Guinean Kina",
        "PHP" => "Philippine Peso",
        "PKR" => "Pakistani Rupee",
        "PLN" => "Polish Zloty",
        "PYG" => "Paraguayan Guarani",
        "QAR" => "Qatari Rial",
        "RON" => "Romanian Leu",
        "RSD" => "Serbian Dinar",
        "RUB" => "Russian Ruble",
        "RWF" => "Rwandan Franc",
        "SAR" => "Saudi Riyal",
        "SBD" => "Solomon Islands Dollar",
        "SCR" => "Seychellois Rupee",
        "SDG" => "Sudanese Pound",
        "SEK" => "Swedish Krona",
        "SGD" => "Singapore Dollar",
        "SHP" => "Saint Helena Pound",
        "SLE" => "Sierra Leonean Leone",
        "SOS" => "Somali Shilling",
        "SRD" => "Surinamese Dollar",
        "STN" => "Sao Tome & Principe Dobra",
        "SVC" => "Salvadoran Colon",
        "SYP" => "Syrian Pound",
        "SZL" => "Swazi Lilangeni",
        "THB" => "Thai Baht",
        "TJS" => "Tajikistani Somoni",
        "TMT" => "Turkmenistan Manat",
        "TND" => "Tunisian Dinar",
        "TOP" => "Tongan Paʻanga",
        "TTD" => "Trinidad & Tobago Dollar",
        "TWD" => "New Taiwan Dollar",
        "TZS" => "Tanzanian Shilling",
        "UAH" => "Ukrainian Hryvnia",
        "UGX" => "Ugandan Shilling",
        "USD" => "US Dollar",
        "UYU" => "Uruguayan Peso",
        "UZS" => "Uzbekistani Som",
        "VES" => "Venezuelan Bolívar",
        "VND" => "Vietnamese Dong",
        "VUV" => "Vanuatu Vatu",
        "WST" => "Samoan Tala",
        "XAF" => "Central African CFA Franc",
        "XCD" => "East Caribbean Dollar",
        "XCG" => "Celo Gold Currency",
        "XDR" => "Special Drawing Rights",
        "XOF" => "West African CFA Franc",
        "XPF" => "CFP Franc",
        "YER" => "Yemeni Rial",
        "ZAR" => "South African Rand",
        "ZMW" => "Zambian Kwacha",
        "ZWL" => "Zimbabwean Dollar"
    );

        foreach ($carray as $k => $v)
            if ($k == $code)
                return $v;

        return null;
    }

    public function jsonCache($ctime, $crypto = 'BTC')
    {
        global $request_type, $purge_cache, $limit_reached, $request_limit;

        // Cache per crypto symbol to avoid mixing values
        $cache_file = dirname(__FILE__) . '/currency_' . strtoupper($crypto) . '.json';
        $expires = time() - $ctime;

        if (!file_exists($cache_file) || filectime($cache_file) < $expires || file_get_contents($cache_file) == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit) 
        {
            $api_results = $this->combine($crypto);
            $json_results = json_encode($api_results);

            if ($api_results && $json_results)
                file_put_contents($cache_file, $json_results);
            else
                unlink($cache_file);
        } 
        else 
        {
            $json_results = file_get_contents($cache_file);
            $request_type = 'JSON';
        }

        return json_decode($json_results);
    }
}