<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 1;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('GET', $url, ['auth' => [$username, $password]]);

$body = (string)$response->getBody();
preg_match('/<!--The password for natas2 is (.*) -->/', $body, $flag);
echo ($flag[1]);
