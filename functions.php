<?php
function readFlag($level)
{
    $file = __DIR__ . '/' . 'level_' . $level . '/' . 'flag.txt';

    if (file_exists($file)) {
        return file($file, FILE_IGNORE_NEW_LINES)[0] ?? null;
    }

    die('No flag for level ' . $level);
}

function debug($var)
{
    switch (gettype($var)) {
        case 'string':
            var_dump($var);
            break;
        case 'array':
        case 'object':
        default:
            echo "\n";
            print_r($var);
            echo "\n";
            break;
    }
}
