<?php

use MCordingley\LinearAlgebra\Vector;

function percentageMatch(array $a, array $b)
{
    /* 
     * Computes the percentage between two vectors (named). 
     * Scalar projection of a on b, as a percentage of the length of b
     * 
    */

    if (count($a) !== count($b)) {
        throw new Exception('Arrays are not the same length.');
    }
    
    // sort the vectors by their keys
    ksort($a);
    ksort($b);

    if (array_keys($a) !== array_keys($b)) {
        throw new Exception('Array keys are not equal.');
    }

    // convert all values to integers
    $va = new Vector(array_values(array_map('intval', $a)));
    $vb = new Vector(array_values(array_map('intval', $b)));


    // return 0 if the lenght of va is 0
    if ($va->length() == 0) {
        return 0;
    }

    // compute scalar projection of a on b (dot(a, b)/len(b)), divided by len(b) again to get percentage
    try {
        return min(max($va->dotProduct($vb) / $vb->length() ** 2 * 100, 10), 100);
    } catch (DivisionByZeroError $e) {
        return null;
    }
}
