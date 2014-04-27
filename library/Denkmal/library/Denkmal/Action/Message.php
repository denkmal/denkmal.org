<?php

class Denkmal_Action_Message extends Denkmal_Action_Abstract {

    public function notify(Denkmal_Model_Message $message) {
        $this->_notify($message);
    }

    protected function _notifyCreate(Denkmal_Model_Message $message) {
        $render = new CM_Render();
        CM_Model_StreamChannel_Message::publish('global-external', 'message-create', array(
            'id'        => $message->getId(),
            'venue'     => $message->getVenue()->getId(),
            'created'   => $message->getCreated()->getTimestamp(),
            'text'      => $message->getText(),
            'image-url' => $message->hasImage() ? $render->getUrlUserContent($message->getImage()->getFile()) : null,
        ));
    }
}
