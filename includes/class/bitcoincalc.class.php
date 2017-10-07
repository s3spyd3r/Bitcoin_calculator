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

    private function getBitcoin()
    {
        $raw  = $this->request('https://cex.io/api/ticker/BTC/USD');
        $data = json_decode($raw, true);

        return $data['last'];
    }

    private function getCurrency()
    {
        $raw  = $this->request('http://api.fixer.io/latest?base=USD');
        $data = json_decode($raw, true);
        
        return $data['rates'];
    }

    public function combine()
    {
        $bvalue = $this->getBitcoin();
        $cvalue = $this->getCurrency();
        
        foreach ($cvalue as $k => $v) {
            $value = $bvalue * $v;
            $bitcoin[$k] = $value;
        }

        $bitcoin['USD'] = $this->getBitcoin();
        
        return $bitcoin;
    }

    public static function code2name($code)
    {
        $carray = array(
            "AUD" => "Australian Dollar",
            "BGN" => "Bulgarian Lev",
            "BRL" => "Brazilian Real",
            "BZD" => "Belize Dollar",
            "CAD" => "Canadian Dollar",
            "CDF" => "Franc Congolais",
            "CHF" => "Swiss Franc",
            "CLP" => "Chilean Peso",
            "CNY" => "Chinese Yuan",
            "COP" => "Colombian Peso",
            "CRC" => "Costa Rican Colon",
            "CSD" => "Serbian Dinar",
            "CUP" => "Cuban Peso",
            "CVE" => "Cape Verde Escudo",
            "CYP" => "Cyprus Pound",
            "CZK" => "Czech Koruna",
            "DJF" => "Djibouti Franc",
            "DKK" => "Danish Krone",
            "EEK" => "Estonian Kroon",
            "EGP" => "Egyptian Pound",
            "ERN" => "Eritrea Nafka",
            "ETB" => "Ethiopian Birr",
            "EUR" => "Euro",
            "FJD" => "Fiji Dollar",
            "GBP" => "Pound Sterling",
            "GIP" => "Gibraltar Pound",
            "HKD" => "Hong Kong Dollar",
            "HRK" => "Croatian Kuna",
            "HUF" => "Hungarian Forint",
            "IDR" => "Indonesian Rupiah",
            "INR" => "Indian Rupee",
            "JPY" => "Japanese Yen",
			"KRW" => "Korean Won",
            "MXN" => "Mexican Peso",
            "NOK" => "Norwegian Krone",
            "NZD" => "New Zealand Dollar",
            "PHP" => "Philippine Peso",
            "PLN" => "Polish Zloty",
            "RON" => "Romanian Leu",
            "RUB" => "Russian Ruble",
            "SEK" => "Swedish Krona",
            "SGD" => "Singapore Dollar",
            "TRY" => "Turkish Lira",
            "TZS" => "Tanzanian Shilling",
            "USD" => "US Dollar"
        );

        foreach ($carray as $k => $v)
            if ($k == $code)
                return $v;
    }

    public function jsonCache($ctime)
    {
        global $request_type, $purge_cache, $limit_reached, $request_limit;

        $cache_file = dirname(__FILE__) . '/currency.json';
        $expires = time() - $ctime;

        if (!file_exists($cache_file))
            die("Cache file is missing: $cache_file");

        if (filectime($cache_file) < $expires || file_get_contents($cache_file) == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit) 
        {
            $api_results = $this->combine();
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
