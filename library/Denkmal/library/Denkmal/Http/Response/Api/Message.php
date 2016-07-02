<?php

class Denkmal_Http_Response_Api_Message extends Denkmal_Http_Response_Api_Abstract {

    protected function _process() {
        $hashToken = self::_getConfig()->hashToken;
        $hashAlgorithm = self::_getConfig()->hashAlgorithm;

        $venue = $this->_params->getVenue('venue');
        $clientId = $this->_params->getString('clientId');
        $clientHash = $this->_params->getString('hash');
        list($text, $imageData) = $this->_getTextAndImage();

        $hashData = (null !== $text) ? $text : md5($imageData);
        $serverHash = hash($hashAlgorithm, $hashToken . $hashData);
        if ($serverHash != $clientHash) {
            throw new CM_Exception_NotAllowed('Not authorised access.');
        }

        $action = new Denkmal_Action_Message(Denkmal_Action_Message::CREATE, $this->getRequest()->getClientId());
        $action->prepare();
        $image = null;
        if (null !== $imageData) {
            $image = Denkmal_Model_MessageImage::create(new CM_Image_Image($imageData));
        }
        $message = Denkmal_Model_Message::create($venue, $clientId, null, $text, $image);
        $action->notify($message);

        $response = $message->toArrayApi($this->getRender());
        $this->_setContent($response);
    }

    /**
     * @return array
     * @throws CM_Exception_Invalid
     */
    private function _getTextAndImage() {
        $text = $this->_params->has('text') ? $this->_params->getString('text') : null;
        $imageData = $this->_params->has('image-data') ? base64_decode($this->_params->getString('image-data')) : null;

        if (null === $text && null === $imageData) {
            throw new CM_Exception_Invalid('Either `text` or `image-data` is required.');
        }

        if (null !== $text && null !== $imageData) {
            throw new CM_Exception_Invalid('Specifying both `text` and `image-data` is not allowed.');
        }

        return array($text, $imageData);
    }

    public static function createFromRequest(CM_Http_Request_Abstract $request, CM_Site_Abstract $site, CM_Service_Manager $serviceManager) {
        if ($request->hasPathPrefix('/api/message') && $request instanceof CM_Http_Request_Post) {
            $request = clone $request;
            $request->popPathPrefix('/api/message');
            $request->setBodyEncoding(CM_Http_Request_Post::ENCODING_FORM);
            return new self($request, $site, $serviceManager);
        }
        return null;
    }

}
