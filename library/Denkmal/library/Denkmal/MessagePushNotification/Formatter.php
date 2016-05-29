<?php

class Denkmal_MessagePushNotification_Formatter {

    /** @var CM_Frontend_Render */
    private $_render;

    /**
     * @param CM_Frontend_Render $render
     */
    public function __construct(CM_Frontend_Render $render) {
        $this->_render = $render;
    }

    /**
     * @param Denkmal_Model_Message $message
     * @return string
     */
    public function getPushData(Denkmal_Model_Message $message) {
        return [
            'title' => $this->getTitle($message),
            'body'  => $this->getBody($message),
            'icon'  => $this->getIcon($message),
            'tag'   => 'message',
            'data'  => [
                'url' => $this->getUrl(),
            ],
        ];
    }

    /**
     * @param Denkmal_Model_Message $message
     * @return string
     */
    public function getTitle(Denkmal_Model_Message $message) {
        return $message->getVenue()->getName();
    }

    /**
     * @param Denkmal_Model_Message $message
     * @return string
     */
    public function getBody(Denkmal_Model_Message $message) {
        $itemList = [];
        if (null !== $message->getUser()) {
            $itemList[] = $message->getUser()->getDisplayName() . ':';
        }
        if (null !== $message->getText()) {
            $itemList[] = $message->getText();
        }
        foreach ($message->getTags()->getAll() as $tag) {
            $itemList[] = '#' . $tag->getLabel();
        }
        if (null !== $message->getImage()) {
            $itemList[] = '#image';
        }
        return implode(' ', $itemList);
    }

    /**
     * @param Denkmal_Model_Message $message
     * @return string
     */
    public function getIcon(Denkmal_Model_Message $message) {
        if ($image = $message->getImage()) {
            return $this->_render->getUrlUserContent($image->getFile('thumb'));
        } else {
            return $this->_render->getUrlResource('layout', 'img/push-notification.png');
        }
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->_render->getUrlPage('Denkmal_Page_Now');
    }
}
