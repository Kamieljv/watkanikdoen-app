<?php

return [
    "ranking" => [
        "asc(start_unix)",
        "typo",
        "geo",
        "words",
        "filters",
        "proximity",
        "attribute",
        "exact",
        "custom",
    ],
    'searchableAttributes' => ['title', 'excerpt', 'body', 'location_human', 'meta_keywords'],
    'customRanking' => ['desc(created_at)', 'desc(updated_at)'],
    'removeStopWords' => null,
    'disableTypoToleranceOnAttributes' => ['slug'],
    'attributesForFaceting' => ['filterOnly(themes.id)', 'filterOnly(organizers.id)'],
    'unretrievableAttributes' => null,
    'ignorePlurals' => null,
    'queryLanguages' => ['nl', 'en'],
    'distinct' => null,
    'attributeForDistinct' => null,
    'replicas' => ['acties_start_unix_asc'],
];
