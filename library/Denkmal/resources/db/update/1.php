<?php

$german = CM_Model_Language::findByAbbreviation('de');
if (!$german) {
	$german = CM_Model_Language::createStatic(array('name' => 'Deutsch', 'abbreviation' => 'de', 'enabled' => true));
}

$german->setTranslation('You', 'Du');
$german->setTranslation('Ok', 'Ok');
$german->setTranslation('Cancel', 'Abbrechen');
$german->setTranslation('Confirmation', 'Rückfrage');
$german->setTranslation('{$label} is required.', '{$label} wird benötigt.', array('label'));
$german->setTranslation('Required', 'Benötigt');
$german->setTranslation('Please Confirm', 'Bitte bestätigen');
$german->setTranslation('.date.timeago.prefixAgo', 'vor');
$german->setTranslation('.date.timeago.prefixFromNow', 'in');
$german->setTranslation('.date.timeago.suffixAgo', '');
$german->setTranslation('.date.timeago.suffixFromNow', '');
$german->setTranslation('.date.timeago.seconds', 'wenigen Sekunden');
$german->setTranslation('.date.timeago.minute', 'etwa einer Minute');
$german->setTranslation('.date.timeago.minutes', '{$count} Minuten');
$german->setTranslation('.date.timeago.hour', 'etwa einer Stunde');
$german->setTranslation('.date.timeago.hours', '{$count} Stunden');
$german->setTranslation('.date.timeago.day', 'etwa einem Tag');
$german->setTranslation('.date.timeago.days', '{$count} Tagen');
$german->setTranslation('.date.timeago.month', 'etwa einem Monat');
$german->setTranslation('.date.timeago.months', '{$count} Monaten');
$german->setTranslation('.date.timeago.year', 'etwa einem Jahr');
$german->setTranslation('.date.timeago.years', '{$count} Jahren');
$german->setTranslation('The content you tried to interact with has been deleted.', 'Dieser Inhalt wurde gelöscht.');
$german->setTranslation('Your browser is no longer supported. Click here to upgrade…', 'Dein Browser wird nicht mehr unterstützt. Klicke hier um ihn zu aktualisieren…');
$german->setTranslation('You can only select {$cardinality} items.', 'Maximal {$cardinality} Element.', array('cardinality'));
