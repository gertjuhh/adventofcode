<?php
declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input.txt');
for ($i = 0; $i < strlen($input) - 4; $i++) {
    if (count(array_unique(str_split(substr($input, $i, 4)))) == 4) {
        break;
    }
}
printf('Start of packet: %s%s', $i + 4, "\n");

for ($i = 0; $i < strlen($input) - 14; $i++) {
    if (count(array_unique(str_split(substr($input, $i, 14)))) == 14) {
        break;
    }
}
printf('Start of message: %s%s', $i + 14, "\n");
