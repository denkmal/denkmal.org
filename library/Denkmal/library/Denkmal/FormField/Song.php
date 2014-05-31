<?php

class Denkmal_FormField_Song extends CM_FormField_SuggestOne {

    /**
     * @param Denkmal_Model_Song $song
     * @param CM_Frontend_Render $render
     * @return array
     */
    public function getSuggestion($song, CM_Frontend_Render $render) {
        return array(
            'id'   => $song->getId(),
            'name' => $song->getLabel(),
        );
    }

    public function validate(CM_Frontend_Environment $environment, $userInput) {
        $userInput = parent::validate($environment, $userInput);
        return new Denkmal_Model_Song($userInput);
    }

    protected function _getSuggestions($term, array $options, CM_Frontend_Render $render) {
        $out = array();
        $songList = new Denkmal_Paging_Song_Search($term);
        $songList->setPage(1, 15);
        foreach ($songList as $song) {
            $out[] = $this->getSuggestion($song, $render);
        }
        return $out;
    }
}
