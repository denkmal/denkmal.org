<?php

class Migration_1489840034_Translations implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        CM_Model_LanguageKey::deleteByName('.meta.description');
        CM_Model_LanguageKey::deleteByName('.meta.description.basel');
        CM_Model_LanguageKey::deleteByName('.meta.description.graz');
        
        CM_Model_Language::findDefault()->setTranslation('.meta.description', '{$siteName} is an event calendar made and curated by locals. We help you explore your city\'s nightlife and make sure you never miss a great party again!');
        CM_Model_Language::findDefault()->setTranslation('.meta.description.basel', 'Basel\'s event calendar made and curated by locals. We help you explore Basel\'s nightlife and make sure you never miss a great party again!');
        CM_Model_Language::findDefault()->setTranslation('.meta.description.graz', 'Graz\' event calendar made and curated by locals. We help you explore Graz\' nightlife and make sure you never miss a great party again!');
    }
}
