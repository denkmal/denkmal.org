<?php

class Denkmal_Http_Response_Api_Messages extends Denkmal_Http_Response_Api_Abstract {

    /** @var int */
    private $_maxMessages = 500;

    /** @var int */
    private $_minMessagesVenue = 500;

    /** @var int|null */
    private $_startAfterId;

    public function __construct(CM_Http_Request_Get $request) {
        parent::__construct($request);

        $params = new Denkmal_Params($request->getQuery());
        $this->_maxMessages = min(max($params->getInt('maxMessages', 500), 1), 5000);
        $this->_minMessagesVenue = min(max($params->getInt('minMessagesVenue', 0), 0), 100);
        $this->_startAfterId = $params->has('startAfterId') ? $params->getInt('startAfterId') : null;
    }

    protected function _process() {
        if (null === $this->_startAfterId) {
            $messageListAll = new Denkmal_Paging_Message_All();
        } else {
            $messageListAll = new Denkmal_Paging_Message_AllAfterId($this->_startAfterId);
        }
        /** @var Denkmal_Model_Message[] $messageList */
        $messageList = $messageListAll->setPage(1, $this->_maxMessages)->getItems();

        foreach ($this->_getVenuesMissingMessages($messageList) as $venue) {
            $messageListVenue = new Denkmal_Paging_Message_Venue($venue);
            $messageList = array_merge($messageList, $messageListVenue->setPage(1, $this->_minMessagesVenue)->getItems());
        }

        $this->_setContent($this->_getResponseByMessageList($messageList));
    }

    /**
     * @param Denkmal_Model_Message[] $messageList
     * @return Denkmal_Model_Venue[]
     */
    private function _getVenuesMissingMessages(array $messageList) {
        if (0 === $this->_minMessagesVenue) {
            return array();
        }
        $dateStart = Denkmal_Site::getCurrentDate();
        $dateEnd = Denkmal_Site::getCurrentDate()->add(new DateInterval('P6D'));
        $venueList = new Denkmal_Paging_Venue_HasEventsWithin($dateStart, $dateEnd);

        $messageCountByVenue = array();
        foreach ($messageList as $message) {
            $venueId = $message->getVenue()->getId();
            if (!isset($messageCountByVenue[$venueId])) {
                $messageCountByVenue[$venueId] = 0;
            }
            $messageCountByVenue[$venueId]++;
        }

        $minMessagesVenue = $this->_minMessagesVenue;
        return Functional\filter($venueList, function (Denkmal_Model_Venue $venue) use ($messageCountByVenue, $minMessagesVenue) {
            return !isset($messageCountByVenue[$venue->getId()]) || $messageCountByVenue[$venue->getId()] < $minMessagesVenue;
        });
    }

    /**
     * @param Denkmal_Model_Message[] $messageList
     * @return array
     */
    private function _getResponseByMessageList(array $messageList) {
        usort($messageList, function (Denkmal_Model_Message $a, Denkmal_Model_Message $b) {
            if ($a->getCreated() == $b->getCreated()) {
                return 0;
            }
            return ($a->getCreated() < $b->getCreated()) ? -1 : 1;
        });

        $messageList = Functional\unique($messageList, function (Denkmal_Model_Message $message) {
            return $message->getId();
        });

        $render = $this->getRender();
        $messageList = Functional\map($messageList, function (Denkmal_Model_Message $message) use ($render) {
            return $message->toArrayApi($render);
        });

        return array_values($messageList);
    }

    public static function match(CM_Http_Request_Abstract $request) {
        if (!parent::match($request)) {
            return false;
        }
        return $request->getPathPart(1) === 'messages';
    }
}
