<?php

require_once dirname(__DIR__) . '/bootstrap.php';

$level = 3;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/s3cr3t/users.txt', $username);

$response = $client->request('GET', $url, ['auth' => [$username, $password]]);

$body = (string)$response->getBody();
preg_match('/natas4:(.*)/', $body, $flag);
echo ($flag[1]);
