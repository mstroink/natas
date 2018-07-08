<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 6;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'submit' => 'submit',
        'secret' => 'FOEIUWGHFEEUHOFUOIU', //from includes/secret.inc
    ],
]);

$body = (string)$response->getBody();

preg_match('/Access granted\. The password for natas7 is (.*)/', $body, $flag);
echo $flag[1];
