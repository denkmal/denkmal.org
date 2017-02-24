<?php

class Denkmal_EventTweeter_EventTweeter {

    /** @var Denkmal_Twitter_Client */
    private $_client;

    /** @var  CM_Frontend_Render */
    private $_render;

    /**
     * @param Denkmal_Twitter_Client $client
     * @param CM_Frontend_Render     $render
     */
    public function __construct(Denkmal_Twitter_Client $client, CM_Frontend_Render $render) {
        $this->_client = $client;
        $this->_render = $render;
    }

    /**
     * @param Denkmal_Model_Event $event
     */
    public function sendTweet(Denkmal_Model_Event $event) {
        $text = $this->getEventText($event, 140);
        $this->_client->createTweet($text);
    }

    /**
     * @param Denkmal_Model_Event $event
     * @param int                 $maxLength
     * @throws CM_Exception_Invalid
     * @return string
     */
    public function getEventText(Denkmal_Model_Event $event, $maxLength) {
        $maxLength = (int) $maxLength;
        $url = $this->_render->getUrlPage('Denkmal_Page_Events', ['date' => $event->getFrom()->format('Y-n-j')]);
        $url = preg_replace('#^https?://(www\.)?#', '', $url);
        $suffix = ' ' . $url;
        $suffixLength = $this->_client->getTweetLength($suffix);
        if ($suffixLength > $maxLength) {
            throw new CM_Exception_Invalid('Suffix length exceeds max-length.', null, ['suffix' => $suffix, 'maxLength' => $maxLength]);
        }

        $prefix = $this->_formatEvent($event);
        $prefixLengthMax = $maxLength - $suffixLength;
        $prefixLengthSubtractor = 0;
        while ($this->_client->getTweetLength($prefix) > $prefixLengthMax) {
            $usertextMaxLength = new CM_Usertext_Usertext();
            $usertextMaxLength->addFilter(new CM_Usertext_Filter_MaxLength($prefixLengthMax - $prefixLengthSubtractor));
            $prefix = $usertextMaxLength->transform($prefix, $this->_render);
            $prefixLengthSubtractor++;
        }

        return $prefix . $suffix;
    }

    /**
     * @param Denkmal_Model_Event $event
     * @return string
     */
    private function _formatEvent(Denkmal_Model_Event $event) {
        $text = 'Denkmal recommends: ';
        if ($event->getVenue()->getTwitterUsername()) {
            $text .= '@' . $event->getVenue()->getTwitterUsername();
        } else {
            $text .= $event->getVenue()->getName();
        }
        $text .= ' (';
        $text .= $this->_formatTime($event->getFrom());
        if ($event->getUntil()) {
            $text .= '-' . $this->_formatTime($event->getUntil());
        }
        $text .= ') ';

        $eventFormatter = new Denkmal_EventFormatter_EventFormatter($this->_render);
        $text .= $eventFormatter->getText($event);

        return $text;
    }

    /**
     * @param DateTime $date
     * @return string
     */
    private function _formatTime(DateTime $date) {
        $formatter = $this->_render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'H:mm');
        return $formatter->format($date->getTimestamp());
    }
}
