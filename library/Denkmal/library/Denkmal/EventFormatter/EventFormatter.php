<?php

class Denkmal_EventFormatter_EventFormatter {

    /** @var CM_Frontend_Render */
    private $_render;

    /**
     * @param CM_Frontend_Render $render
     */
    public function __construct(CM_Frontend_Render $render) {
        $this->_render = $render;
    }

    /**
     * @param Denkmal_Model_Event $event
     * @return string
     */
    public function getHtml(Denkmal_Model_Event $event) {
        $genresFormatter = new Denkmal_EventFormatter_GenresFormatter();

        $genres = $event->getGenres();
        $genres = $genresFormatter->transform($genres, $this->_render);

        $description = $event->getDescription();
        if ($genres) {
            $description = $this->_addPunctuation($description);
        }
        $description = $this->_escape($description);

        $parts = [$description, $genres];
        $parts = array_filter($parts);
        return join(' ', $parts);
    }

    /**
     * @param Denkmal_Model_Event $event
     * @return string
     */
    public function getText(Denkmal_Model_Event $event) {
        $html = $this->getHtml($event);
        return html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8');
    }

    /**
     * @param string $string
     * @return string
     */
    private function _addPunctuation($string) {
        if (empty($string)) {
            return '';
        }
        $end = substr($string, -1);
        if (strrpos('.!?:', $end) === false) {
            $string .= '.';
        }
        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    private function _escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}