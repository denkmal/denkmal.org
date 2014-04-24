<?php

class Denkmal_Response_Api_Messages extends Denkmal_Response_Api_Abstract {

    /** @var int */
    private $_maxMessages = 500;

    /** @var int */
    private $_minMessagesVenue = 500;

    public function __construct(CM_Request_Get $request) {
        parent::__construct($request);

        $params = new Denkmal_Params($request->getQuery());
        $this->_maxMessages = min(max($params->getInt('maxMessages', 500), 1), 2000);
        $this->_minMessagesVenue = min(max($params->getInt('minMessagesVenue', 10), 0), 100);
    }

    protected function _process() {
        $messageListAll = new Denkmal_Paging_Message_All();

        $messageList = array_merge(
            $messageListAll->getItems(-$this->_maxMessages)
        );

        usort($messageList, function (Denkmal_Model_Message $a, Denkmal_Model_Message $b) {
            if ($a->getCreated() == $b->getCreated()) {
                return 0;
            }
            return ($a->getCreated() < $b->getCreated()) ? -1 : 1;
        });

        $response = Functional\map($messageList, function (Denkmal_Model_Message $message) {
            return $message->toArrayApi($this->getRender());
        });
        $this->_setContent($response);
    }

    public static function match(CM_Request_Abstract $request) {
        if (!parent::match($request)) {
            return false;
        }
        return $request->getPathPart(1) === 'messages';
    }
}
