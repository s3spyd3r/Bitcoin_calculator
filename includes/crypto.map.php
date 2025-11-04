<?php
// Ensure config is available (base_url)
require_once(dirname(__FILE__) . '/site.config.php');

// Mapping for supported cryptocurrencies
$cryptos = array(
    'BTC' => array('name' => 'Bitcoin', 'color' => '#0B1F3A', 'logo' => $config['base_url'] . '/assets/img/btc.svg'),
    'ETH' => array('name' => 'Ethereum', 'color' => '#C99D66', 'logo' => $config['base_url'] . '/assets/img/eth.svg'),
    'LTC' => array('name' => 'Litecoin', 'color' => '#0F1626', 'logo' => $config['base_url'] . '/assets/img/ltc.svg'),
    'BCH' => array('name' => 'Bitcoin Cash', 'color' => '#0b2e3d', 'logo' => $config['base_url'] . '/assets/img/bch.svg')
);

// default selection if not set
if (!isset($selected_coin))
    $selected_coin = 'BTC';

// populate config overrides for header/template
if (isset($cryptos[$selected_coin])) {
    $config['selected_coin'] = $selected_coin;
    $config['selected_coin_name'] = $cryptos[$selected_coin]['name'];
    $config['site_color'] = $cryptos[$selected_coin]['color'];
    $config['site_logo'] = $cryptos[$selected_coin]['logo'];
} else {
    // fallback to BTC
    $config['selected_coin'] = 'BTC';
    $config['selected_coin_name'] = 'Bitcoin';
    $config['site_logo'] = $config['base_url'] . '/assets/img/logo.png';
}

// compute a readable text color for the site elements (simple luminance check)
function _hex2rgb($hex) {
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(str_repeat(substr($hex,0,1),2));
        $g = hexdec(str_repeat(substr($hex,1,1),2));
        $b = hexdec(str_repeat(substr($hex,2,1),2));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    return array($r,$g,$b);
}

if (isset($config['site_color'])) {
    list($r,$g,$b) = _hex2rgb($config['site_color']);
    $lum = (0.299 * $r) + (0.587 * $g) + (0.114 * $b);
    $config['site_text_color'] = ($lum > 186) ? '#000000' : '#FFFFFF';
} else {
    $config['site_text_color'] = '#FFFFFF';
}


?>
