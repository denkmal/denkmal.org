<?php

class Denkmal_Layout_Default extends CM_Layout_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $site = $environment->getSite();
        $region = null;

        if ($site instanceof Denkmal_Site_Default && $site->hasRegion()) {
            $region = $site->getRegion();
            $messageList = $site->getRegion()->getMessageList();
            $viewResponse->getJs()->setProperty('chatActivityStamp', $messageList->getLastActivityStamp());

            $timeZone = $region->getTimeZone();
            if ($this->isNightMode($timeZone)) {
                $viewResponse->addCssClass('night-mode');
            }
        }

        $viewResponse->set('region', $region);
        $viewResponse->getJs()->setProperty('region', $region);
    }

    /**
     * @param DateTimeZone $timeZone
     * @return bool
     */
    public function isNightMode($timeZone) {
        $date = new DateTime();
        $date->setTimezone($timeZone);
        $currentHour = date('H', $date->getTimestamp());

        return $currentHour >= 22 || $currentHour <= 6;
    }
}
