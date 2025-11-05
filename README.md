# Bitcoin Calculator (multi-crypto)

A small PHP-based calculator that shows the fiat value of a selected cryptocurrency using live prices. 
The project supports multiple cryptocurrencies (BTC, ETH, LTC, etc.) and is responsive for mobile and tablet devices.

## Features

- Multi-cryptocurrency support via CEX.io ticker API
- Fiat conversion using Fixer.io exchange rates (EUR base)
- Responsive layout built with Bootstrap
- Simple file-based caching of API responses (`includes/class/currency_<COIN>.json`)
- Mobile-friendly inputs with spacing and touch-friendly controls

## Prerequisites

- PHP 7.2+ (recommended) with the following extensions enabled:
	- curl
	- json
- Webserver (one of):
	- XAMPP (recommended for Windows)
	- Built-in PHP server for development
- Internet access (to call external APIs: CEX.io and Fixer.io)

## Configuration

Open `includes/site.config.php`

Note: If your environment uses a different path or URL, update `base_url` accordingly.

## Important implementation notes

- API integrations:
	- Crypto prices come from CEX.io via `https://cex.io/api/ticker/<CRYPTO>/EUR`.
	- Fiat rates come from Fixer.io via `http://data.fixer.io/latest?base=EUR&access_key=<KEY>`.

- Caching:
	- The app writes per-crypto JSON cache files to `includes/class/currency_<COIN>.json`.
	- To force a refresh, delete the relevant cache file or implement a purge in the UI.

- Styling and layout:
	- Coin logos are in `assets/img/` and referenced in `includes/crypto.map.php`.

## Files of interest

- `index.php` — main page
- `calculator.php` — performs form handling / calculation
- `includes/class/bitcoincalc.class.php` — API access, combining prices, caching
- `includes/crypto.map.php` — mapping of coins to colors and logo files
- `includes/wrapper/header.template.php` & `includes/wrapper/footer.template.php` — header/footer templates
- `assets/css/site.css` — main custom CSS
- `assets/img/` — coin logos and images


## Screenshots
![Desktop](https://raw.githubusercontent.com/s3spyd3r/Bitcoin_calculator/master/images/screencapture-desktop.png)

![Mobile](https://raw.githubusercontent.com/s3spyd3r/Bitcoin_calculator/master/images/screencapture-mobile.png)