<?php
declare(strict_types=1);

$rucksacks = array_map('trim', file(__DIR__ . '/input.txt'));
$scores = array_flip(array_merge(['?'], range('a', 'z'), range('A', 'Z')));

$score = 0;
for ($i = 0; $i < count($rucksacks); $i += 3) {
    $score += $scores[preg_replace(
        '/[^' . $rucksacks[$i] . ']/',
        '',
        preg_replace('/[^' . $rucksacks[$i + 1] . ']/', '', $rucksacks[$i + 2])
    )[0]];
}

printf('The sum of priorities: %s%s', $score, "\n");
