<?php
declare(strict_types=1);

$elves = array_map(
    static fn ($in): int => array_sum(explode("\n", $in)),
    preg_split('/^$/m', file_get_contents(__DIR__.'/input.txt'))
);

rsort($elves);

printf('Elf with the most calories: %s%s', $elves[0], "\n");
printf('Top 3 callories combined: %s%s', array_sum(array_slice($elves, 0, 3)), "\n");
