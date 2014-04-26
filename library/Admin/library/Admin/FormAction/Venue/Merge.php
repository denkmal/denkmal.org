<?php

class Admin_FormAction_Venue_Merge extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('oldVenue', 'newVenue');
    }

    protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $oldVenue = $params->getVenue('oldVenue');
        $newVenue = $params->getVenue('newVenue');
        if ($newVenue->equals($oldVenue)) {
            $response->addError($response->getRender()->getTranslation('Ort kann nicht mit sich selbst ersetzt werden.'), 'newVenue');
        }
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $oldVenue = $params->getVenue('oldVenue');
        $newVenue = $params->getVenue('newVenue');

        /** @var Denkmal_Model_Event $event */
        foreach ($oldVenue->getEventList() as $event) {
            $event->setVenue($newVenue);
        }

        /** @var Denkmal_Model_Message $message */
        foreach ($oldVenue->getMessageList() as $message) {
            $message->setVenue($newVenue);
        }

        Denkmal_Model_VenueAlias::create($newVenue, $oldVenue->getName());
        /** @var Denkmal_Model_VenueAlias $alias */
        foreach ($oldVenue->getAliasList() as $alias) {
            $alias->setVenue($newVenue);
        }

        $oldVenue->delete();
    }
}
