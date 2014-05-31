<?php

class Denkmal_Action_Message extends Denkmal_Action_Abstract {

    public function notify(Denkmal_Model_Message $message) {
        $this->_notify($message);
    }

    protected function _notifyCreate(Denkmal_Model_Message $message) {
        $render = new CM_Frontend_Render();
        CM_Model_StreamChannel_Message::publish('global-external', 'message-create', $message->toArrayApi($render));
    }
}
