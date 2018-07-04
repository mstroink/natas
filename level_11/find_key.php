<?php

function xor_encrypt($in, $key) {
    $text = $in;
    $outText = '';

    for ($i = 0; $i < strlen($text); $i++) {
        $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}

//finding key
$defaultData = ["showpassword" => "no", "bgcolor" => "#ffffff"];
$plaintext = json_encode($defaultData);
$defaultCookieValue = 'ClVLIh4ASCsCBE8lAxMacFMZV2hdVVotEhhUJQNVAmhSEV4sFxFeaAw%3D';
$ciphertext = base64_decode(urldecode($defaultCookieValue));
$key = xor_encrypt($plaintext, $ciphertext); //qw8Jqw8Jqw8Jqw8Jqw8Jqw8Jqw8Jqw8Jqw8Jqw8Jq

echo $key;
