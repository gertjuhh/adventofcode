<?php
declare(strict_types=1);

// Rock defeats Scissors, Scissors defeats Paper, and Paper defeats Rock
$rules = [
    'rock' => 'scissors',
    'scissors' => 'paper',
    'paper' => 'rock',
];

$translation = [
    'A' => 'rock',
    'B' => 'paper',
    'C' => 'scissors',
    'X' => 'rock',
    'Y' => 'paper',
    'Z' => 'scissors',
];

$points = [
    'rock' => 1,
    'paper' => 2,
    'scissors' => 3,
];

$games = array_map(
    fn ($in): array => array_map(
        fn ($in): string => $translation[$in],
        explode(' ', trim($in))
    ),
    file(__DIR__.'/input.txt')
);

$score = array_reduce(
    $games,
    function ($score, $game) use ($rules, $points): int {
        if ($game[0] == $game[1]) {
            $score += 3;
        } elseif ($rules[$game[1]] == $game[0]) {
            $score += 6;
        }

        return $score + $points[$game[1]];
    }
);

printf('Total score: %s%s', $score, "\n");
