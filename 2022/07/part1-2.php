<?php
declare(strict_types=1);

$path = $sizes = [];

preg_match_all(
    '/^\$ ([^\n]+)\n([^\$]+)?/m',
    file_get_contents(__DIR__ . '/input.txt'),
    $matches,
    PREG_SET_ORDER | PREG_UNMATCHED_AS_NULL
);
foreach ($matches as $input) {
    [$command, $output] = array_slice($input, 1);
    if ('cd ..' === $command) {
        array_pop($path);
        continue;
    }

    if (str_starts_with($command, 'cd ')) {
        $path[] = substr($command, 3);
        $sizes[implode('/', $path)] = 0;
        continue;
    }

    preg_match_all('/^\d+/m', $output, $fileSizes);
    for ($i = count($path); $i > 0; $i--) {
        $sizes[implode('/', array_slice($path, 0, $i))] += array_sum($fileSizes[0]);
    }
}

$total = array_reduce($sizes, static fn (int $total, int $size): int => $size <= 100000 ? $total + $size : $total, 0);
printf('Total of directories < 100000: %s%s', $total, "\n");

$requiredSpace = 30000000 - (70000000 - $sizes['/']);
$candidates = array_filter($sizes, static fn (int $size): bool => $size > $requiredSpace);
sort($candidates);
printf('Total size of smallest directory which will clear enough space: %s%s', $candidates[0], "\n");
