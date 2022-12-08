<?php
declare(strict_types=1);

$assignments = array_map(
    static fn (string $assignment): array => preg_split('/[-,]/', trim($assignment)),
    file(__DIR__ . '/input.txt')
);

$fullOverlap = array_reduce(
    $assignments,
    static function (int $overlap, array $assignment): int {
        return $overlap + (int) (
                ($assignment[0] >= $assignment[2] && $assignment[1] <= $assignment[3]) ||
                ($assignment[2] >= $assignment[0] && $assignment[3] <= $assignment[1])
            );
    },
    0
);

$overlap = array_reduce(
    $assignments,
    static function (int $overlap, array $assignment): int {
        return $overlap + (int) (
                count(
                    array_intersect(
                        range($assignment[0], $assignment[1]),
                        range($assignment[2], $assignment[3])
                    )
                ) > 0
            );
    },
    0
);

printf('Full overlapping assignments: %s%s', $fullOverlap, "\n");
printf('Total overlapping assignments: %s%s', $overlap, "\n");
