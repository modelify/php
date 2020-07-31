<?php

use Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::create(__DIR__.'/..');
$dotenv->load();

$dotenv->required([
  'MOCKAPI_KEY'
]);

define('MOCKAPI_KEY', getenv('MOCKAPI_KEY'));
