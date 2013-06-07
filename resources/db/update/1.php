<?php

$english = CM_Model_Language::findByAbbreviation('en');
if (!$english) {
	$english = CM_Model_Language::create(array('name' => 'English', 'abbreviation' => 'en', 'enabled' => true));
	CM_Model_Language::create(array('name' => 'Deutsch', 'abbreviation' => 'de', 'enabled' => true, 'backup' => $english));
}

$english->setTranslation('You', 'You');
$english->setTranslation('Ok', 'Ok');
$english->setTranslation('Cancel', 'Cancel');
$english->setTranslation('Confirmation', 'Confirmation');
$english->setTranslation('{$label} is required.', '{$label} is required.', array('label'));
$english->setTranslation('Required', 'Required');
$english->setTranslation('.date.timeago.prefixAgo', '');
$english->setTranslation('.date.timeago.prefixFromNow', '');
$english->setTranslation('.date.timeago.suffixAgo', 'ago');
$english->setTranslation('.date.timeago.suffixFromNow', 'from now');
$english->setTranslation('.date.timeago.seconds', 'less than a minute');
$english->setTranslation('.date.timeago.minute', 'about a minute');
$english->setTranslation('.date.timeago.minutes', '{$count} minutes');
$english->setTranslation('.date.timeago.hour', 'about an hour');
$english->setTranslation('.date.timeago.hours', '{$count} hours');
$english->setTranslation('.date.timeago.day', 'a day');
$english->setTranslation('.date.timeago.days', '{$count} days');
$english->setTranslation('.date.timeago.month', 'about a month');
$english->setTranslation('.date.timeago.months', '{$count} months');
$english->setTranslation('.date.timeago.year', 'about a year');
$english->setTranslation('.date.timeago.years', '{$count} years');
$english->setTranslation('The content you tried to interact with has been deleted.', 'The content you tried to interact with has been deleted.');
$english->setTranslation('Your browser is no longer supported. Click here to upgrade…', 'Your browser is no longer supported. Click here to upgrade…');
