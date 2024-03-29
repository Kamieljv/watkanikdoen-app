<?php

function filterScripts($html)
{
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

    $script = $dom->getElementsByTagName('script');

    $remove = [];
    foreach ($script as $item) {
        $remove[] = $item;
    }
    foreach ($remove as $item) {
        $item->parentNode->removeChild($item);
    }
    return $dom->saveHTML();
}
