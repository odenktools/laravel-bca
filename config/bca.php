<?php

/**
 * Laravel BCA REST API Config.
 *
 * @author     Pribumi Technology
 * @license    MIT
 * @copyright  (c) 2017, Pribumi Technology
 */
return [

    'default'     => 'main',

    'connections' => [

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
            'options' => [
                'host'     => 'sandbox.bca.co.id',
                'scheme'   => 'https',
                'timeout'  => 60,
                'port'     => 443,
                'timezone' => 'Asia/Jakarta'
            ],
            'port'          => 443,
            'timeout'       => 30,
        ],

        'alternative' => [
            'corp_id'       => 'your-corp_id',
            'client_id'     => 'your-client_id',
            'client_secret' => 'your-client_secret',
            'api_key'       => 'your-api_key',
            'secret_key'    => 'your-secret_key',
            'timezone'      => 'Asia/Jakarta',
            'host'          => 'sandbox.bca.co.id',
            'scheme'        => 'https',
            'development'   => true,
            'options' => [
                'host'     => 'sandbox.bca.co.id',
                'scheme'   => 'https',
                'timeout'  => 60,
                'port'     => 443,
                'timezone' => 'Asia/Jakarta'
            ],
            'port'          => 443,
            'timeout'       => 30,
        ],

    ],

];
