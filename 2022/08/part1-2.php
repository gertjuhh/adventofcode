<?php
declare(strict_types=1);

$grid = array_map(static fn (string $in): array => str_split(trim($in)), file(__DIR__ . '/input.txt'));

$visible = count($grid) * count($grid[0]);
$highestScenic = 0;

for ($i = 1; $i < count($grid); $i++) {
    for ($j = 1; $j < count($grid[$i]); $j++) {
        $up = $down = $left = $right = false;
        $scenic = [];

        for ($k = $i - 1; $k >= 0; $k--) {
            if ($grid[$i][$j] <= $grid[$k][$j]) {
                $up = true;
                break;
            }
        }
        $scenic[] = $i - ($up ? $k : 0);

        for ($k = $i + 1; $k < count($grid); $k++) {
            if ($grid[$i][$j] <= $grid[$k][$j]) {
                $down = true;
                break;
            }
        }
        $scenic[] = ($down ? $k : $k - 1) - $i;

        for ($k = $j - 1; $k >= 0; $k--) {
            if ($grid[$i][$j] <= $grid[$i][$k]) {
                $left = true;
                break;
            }
        }
        $scenic[] = $j - ($left ? $k : 0);

        for ($k = $j + 1; $k < count($grid[$i]); $k++) {
            if ($grid[$i][$j] <= $grid[$i][$k]) {
                $right = true;
                break;
            }
        }
        $scenic[] = ($right ? $k : $k - 1) - $j;

        if (true === $up && true === $down && true === $left && true === $right) {
            $visible--;
        }

        if (($scenicScore = array_product($scenic)) > $highestScenic) {
            $highestScenic = $scenicScore;
        }
    }
}

printf('Trees visible from outside of grid: %s%s', $visible, "\n");
printf('Highest scenic score: %s%s', $highestScenic, "\n");
