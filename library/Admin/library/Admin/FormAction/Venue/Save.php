<?php

class Admin_FormAction_Venue_Save extends Admin_FormAction_Abstract {

    protected function _getRequiredFields() {
        return array('venueId', 'name');
    }

    protected function _checkData(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        parent::_checkData($params, $response, $form);
        /** @var Denkmal_Params $params */
        $venue = $params->getVenue('venueId');
        $name = $params->getString('name');
        if ($name !== $venue->getName()) {
            if ($venue = Denkmal_Model_Venue::findByNameOrAlias($name)) {
                $response->addError($response->getRender()->getTranslation('Name wird bereits verwendet'), 'name');
            }
        }
    }

    protected function _process(CM_Params $params, CM_Response_View_Form $response, CM_Form_Abstract $form) {
        /** @var Denkmal_Params $params */
        $venue = $params->getVenue('venueId');
        $name = $params->getString('name');
        $url = $params->has('url') ? $params->getString('url') : null;
        $address = $params->has('address') ? $params->getString('address') : null;
        $coordinates = $params->has('coordinates') ? $params->getGeoPoint('coordinates') : null;
        $ignore = $params->getBoolean('ignore');

        $venue->setName($name);
        $venue->setUrl($url);
        $venue->setAddress($address);
        $venue->setCoordinates($coordinates);
        $venue->setIgnore($ignore);
        $venue->setQueued(false);

        $response->reloadComponent();
    }
}
