[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e008fb31-cb9c-4021-9475-f35c66e14e3e/small.png)](https://insight.sensiolabs.com/projects/e008fb31-cb9c-4021-9475-f35c66e14e3e)
[![Build Status](https://travis-ci.org/odenktools/laravel-bca.svg?branch=master)](https://travis-ci.org/odenktools/laravel-bca)
[![codecov](https://codecov.io/gh/odenktools/laravel-bca/branch/master/graph/badge.svg)](https://codecov.io/gh/odenktools/laravel-bca)
[![Latest Stable Version](https://poser.pugx.org/odenktools/laravel-bca/v/stable)](https://packagist.org/packages/odenktools/laravel-bca)
[![Latest Unstable Version](https://poser.pugx.org/odenktools/laravel-bca/v/unstable)](https://packagist.org/packages/odenktools/laravel-bca)
[![Total Downloads](https://poser.pugx.org/odenktools/laravel-bca/downloads)](https://packagist.org/packages/odenktools/laravel-bca)

# Laravel BCA (Bank Central Asia)

Laravel PHP library untuk mengintegrasikan Aplikasi Anda dengan sistem BCA (Bank Central Asia). Untuk dokumentasi lebih jelas dan lengkap, silahkan kunjungi website resminya di [Developer BCA](https://developer.bca.co.id/documentation)

Library ini support PHP :

* PHP 5.5
* PHP 5.6
* PHP 7.0
* PHP 7.1
* PHP 7.2

Library ini support Laravel :

* Laravel 5.2.x
* Laravel 5.3.x
* Laravel 5.4.x
* Laravel 5.5.x

Jika merasa terbantu dengan adanya library ini, jangan lupa untuk berikan ```STAR``` pada respository ini. Happy Koding!

## Fitur Library

Seluruh fitur, method, property pada Laravel PHP library ini seluruhnya sama dengan [Odenktools PHP BCA](https://github.com/odenktools/php-bca).

* [Installasi](https://github.com/odenktools/laravel-bca#instalasi)
* [Setting](https://github.com/odenktools/laravel-bca#koneksi-dan-setting)
* [Login](https://github.com/odenktools/laravel-bca#login)
* [Informasi Saldo](https://github.com/odenktools/laravel-bca#balance-information)
* [Transfer](https://github.com/odenktools/laravel-bca#fund-transfer)
* [Mutasi Rekening](https://github.com/odenktools/laravel-bca#account-statement)
* [Info Kurs](https://github.com/odenktools/laravel-bca#foreign-exchange-rate)
* [Pencarian ATM Terdekat](https://github.com/odenktools/laravel-bca#nearest-atm-locator)
* [Deposit Rate](https://github.com/odenktools/php-bca#deposit-rate)
* [Generate Signature](https://github.com/odenktools/php-bca#generate-signature)
* [How to contribute](https://github.com/odenktools/php-bca#how-to-contribute)

### INSTALASI

```bash
composer require odenktools/laravel-bca
```

# Setup

Setelah installasi, tambahkan `BcaServiceProvider` pada `providers` laravel. Konfigurasi berada di `config/app.php`

```php
'providers' => [
	// blahh.. blahhh..
	Odenktools\Bca\BcaServiceProvider::class,
]
```

Setelah itu tambahkan Facade `Bca` pada Laravel `aliases` array. Konfigurasi berada di `config/app.php`

```php
'aliases' => [
	// blahh.. blahhh..
	'Bca'  => Odenktools\Bca\Facades\Bca::class,
]
```

Publish Konfigurasi yang dipergunakan oleh library

```bash
php artisan vendor:publish --provider="Odenktools\Bca\BcaServiceProvider"

composer dumpautoload
```

### KONEKSI DAN SETTING

Papda Konfigurasi `config/Bca.php`, silahkan input Environment yang sesuai dengan kebutuhan Anda. Pastikan ```CORP_ID, CLIENT_KEY, CLIENT_SECRET, APIKEY, SECRETKEY``` telah diketahui.

```php
        'main'        => [
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
            'timezone'      => 'Asia/Jakarta',
            'host'          => 'sandbox.bca.co.id',
            'scheme'        => 'https',
            'development'   => true,
            'options'       => [],
            'port'          => 443,
            'timeout'       => 30,
        ],
```

### LOGIN

```php
	// Request Login dan dapatkan nilai OAUTH
	$response = \Bca::httpAuth();

	// LIHAT HASIL OUTPUT
	echo json_encode($response);
```

Setelah Login berhasil pastikan anda menyimpan nilai ```TOKEN``` di tempat yang aman, karena nilai ```TOKEN``` tersebut agar digunakan untuk tugas tugas berikutnya.

### BALANCE INFORMATION

Pastikan anda mendapatkan nilai ```TOKEN``` dan ```TOKEN``` tersebut masih berlaku (Tidak Expired).

```php
	// Nilai token yang dihasilkan saat login
	$token = "MvXPqa5bQs5U09Bbn8uejBE79BjI3NNCwXrtMnjdu52heeZmw9oXgB";

	//Nomor akun yang akan di ambil informasi saldonya, menggunakan ARRAY
	$arrayAccNumber = array('0201245680', '0063001004', '1111111111');

	$response = \Bca::getBalanceInfo($token, $arrayAccNumber);
	
	// LIHAT HASIL OUTPUT
	echo json_encode($response);
```

### FUND TRANSFER

Pastikan anda mendapatkan nilai ```TOKEN``` dan ```TOKEN``` tersebut masih berlaku (Tidak Expired).

```php
	// Nilai token yang dihasilkan saat login
	$token = "MvXPqa5bQs5U09Bbn8uejBE79BjI3NNCwXrtMnjdu52heeZmw9oXgB";

	$amount = '50000.00';

	// Nilai akun bank anda
	$nomorakun = '0201245680';

	// Nilai akun bank yang akan ditransfer
	$nomordestinasi = '0201245681';

	// Nomor PO, silahkan sesuaikan
	$nomorPO = '12345/PO/2017';

	// Nomor Transaksi anda, Silahkan generate sesuai kebutuhan anda
	$nomorTransaksiID = '00000001;

	$response = \Bca::fundTransfers($token, 
						$amount,
						$nomorakun,
						$nomordestinasi,
						$nomorPO,
						'Testing Saja Ko',
						'Online Saja Ko',
						$nomorTransaksiID);

	echo json_encode($response);
```

### ACCOUNT STATEMENT

Pastikan anda mendapatkan nilai ```TOKEN``` dan ```TOKEN``` tersebut masih berlaku (Tidak Expired).

```php
	// Nilai token yang dihasilkan saat login
	$token = "MvXPqa5bQs5U09Bbn8uejBE79BjI3NNCwXrtMnjdu52heeZmw9oXgB";

	// Nilai akun bank anda
	$nomorakun = '0201245680';
	
	// Tanggal start transaksi anda
	$startdate = '2016-08-29';
	
	// Tanggal akhir transaksi anda
	$enddate = '2016-09-01';

	$response = \Bca::getAccountStatement($token, $nomorakun, $startdate, $enddate);

	echo json_encode($response);
```

### FOREIGN EXCHANGE RATE

```php
	//Tipe rate :  bn, e-rate, tt, tc
	$rateType = 'e-rate';

	$mataUang = 'usd';

	$response = \Bca::getForexRate($token, $rateType, $mataUang);

	echo json_encode($response);
```

### NEAREST ATM LOCATOR

```php
	$latitude = '-6.1900718';

	$longitude = '106.797190';

	$totalAtmShow = '10';

	$radius = '20';

	$response = \Bca::getAtmLocation($token, $latitude, $longitude, $totalAtmShow, $radius);

	echo json_encode($response);
```

### DEPOSIT RATE

Pastikan anda mendapatkan nilai ```TOKEN``` dan ```TOKEN``` tersebut masih berlaku (Tidak Expired).

```php
	// Nilai token yang dihasilkan saat login
	$token = "MvXPqa5bQs5U09Bbn8uejBE79BjI3NNCwXrtMnjdu52heeZmw9oXgB";

	$response       = \Bca::getDepositRate($token);

	echo json_encode($response);
```

### GENERATE SIGNATURE

Saat berguna untuk keperluan testing.

```php

	$secret = "NILAI-SECRET-ANDA";
	
	// Nilai token yang dihasilkan saat login
	$token = "MvXPqa5bQs5U09Bbn8uejBE79BjI3NNCwXrtMnjdu52heeZmw9oXgB";
	
	$uriSign = "GET:/general/info-bca/atm";
	
	//Format timestamp harus dalam ISO8601 format (yyyy-MM-ddTHH:mm:ss.SSSTZD)
	$isoTime = "2016-02-03T10:00:00.000+07:00";
	
	$bodyData = array();
	
	//nilai body anda disini
	$bodyData['a'] = "BLAAA-BLLLAA";
	$bodyData['b'] = "BLEHH-BLLLAA";
	
	//ketentuan BCA array harus disort terlebih dahulu
	ksort($bodyData);

	$authSignature = \Bca::generateSign($uriSign, $token, $secret, $isoTime, $bodyData);
	
	echo $authSignature;
```


# How to contribute

Lakukan Fork pada repository ini.

Buat feature ```branch``` dengan cara

```bash
git checkout -b my-new-feature
```

Lakukan modifikasi pada repository anda tersebut. Setelah selesai lakukan commit

```bash
git commit -am 'Menambahkan fitur xxx'
```

Lakukan ```Push``` ke branch yang telah dibuat

```bash
git push origin my-new-feature
```

Lakukan pull request ke repository ini, Selesai.

## Guidelines

* Koding berstandart [PSR-2 Coding Style Guide](http://www.php-fig.org/psr/psr-2/)
* Pastikan seluruh test yang dilakukan telah pass, jika anda menambahkan fitur baru, anda diharus kan untuk membuat unit test terkait dengan fitur tersebut.
* Pergunakan [rebase](https://git-scm.com/book/en/v2/Git-Branching-Rebasing) untuk menghindari conflict dan merge kode
* Jika anda menambahkan fitur, mungkin anda juga harus mengupdate halaman dokumentasi pada repository ini.

# LICENSE

MIT License

Copyright (c) 2017 odenktools

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
