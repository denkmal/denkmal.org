<?php

CM_Model_LanguageKey::deleteByName('{$siteName} - Basel\'s event calendar. What\'s up in Basel and how does it sound?');
CM_Model_LanguageKey::deleteByName('{$siteName} is an event calendar by locals. What\'s up in {$region} and how does it sound?');
CM_Model_LanguageKey::deleteByName('{$siteName} is an event calendar by locals. Explore your city\'s nightlife and get event updates and impressions by the crowd in real-time.');

$en = CM_Model_Language::findByAbbreviation('en');
$en->setTranslation('.meta.description', '{$siteName} is an event calendar by locals. Explore your city\'s nightlife and get event updates and impressions by the crowd in real-time.');
$en->setTranslation('.meta.description.basel', 'Basel\'s event calendar by locals. Explore Basel\'s nightlife and get event updates and impressions by the crowd in real-time.');
$en->setTranslation('.meta.description.graz', 'Graz\' event calendar by locals. Explore Graz\' nightlife and get event updates and impressions by the crowd in real-time.');

$de = CM_Model_Language::findByAbbreviation('de');
$de->setTranslation('.meta.description', '{$siteName} wird von Locals gemacht. Entdecke das Nachtleben deiner Stadt, und finde heraus was jetzt gerade läuft.');
$de->setTranslation('.meta.description.basel', 'Basels Eventkalender. WaslOift am Rheinknie und wie hört es sich an?');
$de->setTranslation('.meta.description.graz', 'Events in Graz. Was geht in der Metropole an der Mur?');
