<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'functions.php';

$client = new \GuzzleHttp\Client(['cookies' => true]);
