<?php
declare(strict_types=1);

$rucksacks = array_map('trim', file(__DIR__ . '/input.txt'));
$scores = array_flip(array_merge(['?'], range('a', 'z'), range('A', 'Z')));

$score = array_reduce(
    $rucksacks,
    function ($score, $rucksack) use ($scores): int {
        [$first, $second] = str_split($rucksack, strlen($rucksack) / 2);

        return $score + $scores[preg_replace('/[^' . $first . ']/', '', $second)[0]];
    },
    0
);

printf('The sum of priorities: %s%s', $score, "\n");
