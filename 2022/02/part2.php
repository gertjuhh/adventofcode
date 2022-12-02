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
    'X' => 'lose',
    'Y' => 'draw',
    'Z' => 'win',
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
    file('input.txt')
);

$score = array_reduce(
    $games,
    function ($score, $game) use ($points, $rules) {
        $play = match ($game[1]) {
            'draw' => $game[0],
            'win' => \array_flip($rules)[$game[0]],
            'lose' => $rules[$game[0]],
        };

        if ($game[0] == $play) {
            $score += 3;
        } elseif ($rules[$play] == $game[0]) {
            $score += 6;
        }

        return $score + $points[$play];
    }
);

printf('Total score: %s%s', $score, "\n");
