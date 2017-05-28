<?php

class Denkmal_Form_EventAdd extends CM_Form_Abstract {

    protected function _initialize() {
        /** @var Denkmal_Params $params */
        $params = $this->getParams();
        $region = $params->getRegion('region');
        $timeZone = $region->getTimeZone();

        $this->registerField(new Denkmal_FormField_Venue(['name' => 'venue', 'region' => $region, 'enableChoiceCreate' => true]));
        $this->registerField(new CM_FormField_Text(['name' => 'venueAddress']));
        $this->registerField(new CM_FormField_Url(['name' => 'venueUrl']));

        $this->registerField(new CM_FormField_Date(['name'      => 'date', 'timeZone' => $timeZone,
                                                    'yearFirst' => date('Y'), 'yearLast' => (int) date('Y') + 1]));
        $this->registerField(new CM_FormField_Time(['name' => 'fromTime', 'timeZone' => $timeZone]));
        $this->registerField(new CM_FormField_Time(['name' => 'untilTime', 'timeZone' => $timeZone]));

        $this->registerField(new CM_FormField_Text(['name' => 'title']));
        $this->registerField(new CM_FormField_Text(['name' => 'artists']));
        $this->registerField(new CM_FormField_Text(['name' => 'genres']));
        $this->registerField(new Denkmal_FormField_UrlEventLink(['name' => 'link']));

        $this->registerAction(new Denkmal_FormAction_EventAdd_Create($this));
        $this->registerAction(new Denkmal_FormAction_EventAdd_Preview($this));
    }

    protected function _getRequiredFields() {
        return array('venue', 'date', 'fromTime');
    }

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        $this->getField('date')->setValue(new DateTime());
        $fromTime = new DateTime();
        $fromTime->setTime(22, 00);
        $this->getField('fromTime')->setValue($fromTime);
    }

    /**
     * @param Denkmal_Params       $params
     * @param Denkmal_Model_Region $region
     * @return Denkmal_Model_Venue
     */
    public static function getVenueFromData(Denkmal_Params $params, Denkmal_Model_Region $region) {
        /** @var Denkmal_Params $params */
        $venue = $params->get('venue');
        if (!$venue instanceof Denkmal_Model_Venue) {
            $name = (string) $venue;
            $venue = Denkmal_Model_Venue::findByNameOrAlias($region, $name);

            if (null === $venue) {
                $address = $params->has('venueAddress') ? $params->getString('venueAddress') : null;
                $url = $params->has('venueUrl') ? $params->getString('venueUrl') : null;

                $venue = new Denkmal_Model_Venue();
                $venue->setName($name);
                $venue->setUrl($url);
                $venue->setAddress($address);
                $venue->setRegion($region);
                $venue->setCoordinates(null);
                $venue->setQueued(true);
                $venue->setIgnore(false);
                $venue->setSuspended(false);
                $venue->setSecret(false);
                $venue->setEmail(null);
                $venue->setTwitterUsername(null);
                $venue->setFacebookPage(null);
            }
        }
        return $venue;
    }

    /**
     * @param Denkmal_Params $params
     * @return Denkmal_Model_Event
     */
    public static function getEventFromData(Denkmal_Params $params) {
        $date = $params->getDateTime('date');
        $from = clone $date;
        $from->add($params->getDateInterval('fromTime'));
        $until = null;
        if ($params->has('untilTime')) {
            $until = clone $date;
            $until->add($params->getDateInterval('untilTime'));
            if ($until < $from) {
                $until->add(new DateInterval('P1D'));
            }
        }

        $artists = $params->has('artists') ? $params->getString('artists') : null;
        $title = $params->has('title') ? $params->getString('title') : null;
        $genres = $params->has('genres') ? new Denkmal_Scraper_Genres($params->getString('genres')) : null;
        $description = new Denkmal_Scraper_Description($artists, $title, $genres);
        $event = new Denkmal_Model_Event();
        $event->setDescription($description->getTitleAndDescription());
        $event->setGenres($description->getGenres());
        $event->setEnabled(false);
        $event->setQueued(true);
        $event->setFrom($from);
        $event->setUntil($until);
        $event->setSong(null);
        $event->setHidden(false);
        $event->setStarred(false);

        return $event;
    }
}
