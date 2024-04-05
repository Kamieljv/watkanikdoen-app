<?php

function euclidianDistance(array $vec1, array $vec2)
{
    if (count($vec1) !== count($vec2)) {
        throw new Exception('Arrays are not the same length.');
    }
    $sum = null;
    foreach ($vec1 as $k => $e1) {
        $e2 = $vec2[$k];
        $sum += ($e2 - $e1)**2;
    }
    return sqrt($sum);
}
