<?php

use App\Classes\Session;

$flutterwave = array(
    'secret_key' => getenv('FLUTTERWAVE_SECRET'),
    'public_key' => getenv('FLUTTERWAVE_PUBLIC')
);

Session::add('public_key', $flutterwave['public_key']);