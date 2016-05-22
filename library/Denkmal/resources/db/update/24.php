<?php

$deactivateTags = [
    'rabbit',
    'sexy',
];

foreach ($deactivateTags as $label) {
    $tag = Denkmal_Model_Tag::findByLabel($label);
    $tag->setActive(false);
}

$newTags = [
    'cake',
    'cocktail',
    'dancing',
    'football',
    'icecream',
    'police',
    'sun',
    'sunglasses',
];

foreach ($newTags as $tag) {
    Denkmal_Model_Tag::create($tag);
}

