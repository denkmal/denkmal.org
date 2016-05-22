<?php

class Admin_Component_TranslationList extends Denkmal_Component_Abstract {

    public function checkAccessible(CM_Frontend_Environment $environment) {
        if (!$environment->getViewer(true)->getRoles()->contains(Denkmal_Role::ADMIN)) {
            throw new CM_Exception_NotAllowed();
        }
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $activeLanguage = $this->_params->getLanguage('language');
        $translated = $this->_params->has('translated') ? $this->_params->getBoolean('translated') : null;
        $searchPhrase = $this->_params->has('phrase') ? $this->_params->getString('phrase') : null;
        $searchSection = $this->_params->has('section') ? $this->_params->getString('section') : null;
        $translationList = new CM_Paging_Translation_Language_Search($activeLanguage, $searchPhrase, $searchSection, $translated);

        if ($activeLanguage->getBackup()) {
            $backupTranslationList = $activeLanguage->getBackup()->getTranslations()->getAssociativeArray();
            $backupWordCount = 0;
            foreach ($translationList->getAssociativeArray() as $key => $activeTranslation) {
                $backupValue = $backupTranslationList[$key]['value'];
                if ($backupValue === null) {
                    $backupValue = $key;
                }
                $backupTranslationList[$key]['wordCount'] = str_word_count($backupValue);
                $backupWordCount += $backupTranslationList[$key]['wordCount'];
            }
            $viewResponse->set('backupLanguage', $activeLanguage->getBackup());
            $viewResponse->set('backupTranslationList', $backupTranslationList);
            $viewResponse->set('backupWordCount', $backupWordCount);
        }

        $viewResponse->set('languageList', new CM_Paging_Language_All());
        $viewResponse->set('activeLanguage', $activeLanguage);
        $viewResponse->set('translated', $translated);
        $viewResponse->set('translationList', $translationList->setPage($this->getParams()->getPage(), 100));
        $viewResponse->set('searchPhrase', $searchPhrase);
        $viewResponse->set('searchSection', $searchSection);
    }
}
