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
            if (null !== $cssNightMode = $this->isNightMode($timeZone)) {
                $viewResponse->addCssClass($cssNightMode);
            }
        }

        $viewResponse->set('region', $region);
        $viewResponse->getJs()->setProperty('region', $region);
    }

    /**
     * @param DateTimeZone $timeZone
     * @return string|null
     */
    public function isNightMode($timeZone) {
        $date = new DateTime();
        $date->setTimezone($timeZone);
        $currentHour = date('H', $date->getTimestamp());

        $cssClass = null;
        if ($currentHour >= 22 || $currentHour <= 6) {
            $cssClass = 'night-mode';

            if ($currentHour >= 1) {
                $cssClass = 'night-mode-late';
            }
        }

        return $cssClass;
    }
}
