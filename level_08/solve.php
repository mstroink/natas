<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 8;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function reverseEncodedSecret($encodedSecret)
{
    return base64_decode(strrev(hex2bin($encodedSecret))); //reverse process bin2hex(strrev(base64_encode($secret)));
}

$secret = reverseEncodedSecret($encodedSecret);

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'form_params' => [
        'submit' => 'submit',
        'secret' => $secret
    ]
]);

$body = (string)$response->getBody();

preg_match("/The password for natas9 is (.*)/", $body, $flag);
echo $flag[1];
