<?php
declare(strict_types=1);

$input = explode("\n\n", file_get_contents(__DIR__ . '/input.txt'));

$stacks = [];
foreach (array_slice(explode("\n", $input[0]), 0, -1) as $line) {
    foreach (str_split($line, 4) as $stackNumber => $stackLine) {
        if ($stackLine[1] != ' ') {
            $stacks[$stackNumber + 1][] = $stackLine[1];
        }
    }
}
ksort($stacks);

$slowStacks = $fastStacks = $stacks;
foreach (explode("\n", trim($input[1])) as $move) {
    preg_match_all('/\d+/', $move, $numbers);
    [$amount, $from, $to] = array_map('intval', $numbers[0]);

    $slowStacks[$to] = array_merge(array_reverse(array_slice($slowStacks[$from], 0, $amount)), $slowStacks[$to]);
    $slowStacks[$from] = array_slice($slowStacks[$from], $amount);

    $fastStacks[$to] = array_merge(array_slice($fastStacks[$from], 0, $amount), $fastStacks[$to]);
    $fastStacks[$from] = array_slice($fastStacks[$from], $amount);
}

print('Top crates CrateMover 9000: ');
foreach ($slowStacks as $stack) {
    print($stack[0]);
}
print("\n");

print('Top crates CrateMover 9001: ');
foreach ($fastStacks as $stack) {
    print($stack[0]);
}
print("\n");
