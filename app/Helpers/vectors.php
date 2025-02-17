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

    // Check for one-dimensional vectors
    if ($va->getSize() == 1 && $vb->getSize() == 1) {
        // Calculate similarity score for one-dimensional vectors
        $similarity = ($va[0] == 0 || $vb[0] == 0) ? 0 : ($va[0] / $vb[0]) * 100;
        return min(max($similarity, 10), 100);
    }

    // compute cosine similarity of a on b (https://en.wikipedia.org/wiki/Cosine_similarity)
    try {
        return min(max($va->cosineSimilarity($vb) * 100, 10), 100);
    } catch (DivisionByZeroError $e) {
        return null;
    }
}
