<?php

return [
    'searchableAttributes' => ['title', 'excerpt', 'body', 'location_human', 'meta_keywords'],
    'customRanking' => ['desc(created_at)', 'desc(updated_at)'],
    'removeStopWords' => null,
    'disableTypoToleranceOnAttributes' => ['slug'],
    'attributesForFaceting' => ['filterOnly(themes.id)', 'filterOnly(organizers.id)', 'filterOnly(categories.id)'],
    'unretrievableAttributes' => null,
    'ignorePlurals' => null,
    'queryLanguages' => ['nl', 'en'],
    'distinct' => null,
    'attributeForDistinct' => null,
    'replicas' => ['acties_start_unix_asc'],
];
