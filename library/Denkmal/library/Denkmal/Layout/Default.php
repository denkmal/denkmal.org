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
            $nightmodeClass = $this->_getNightmodeClass($timeZone);
            if (null !== $nightmodeClass) {
                $viewResponse->addCssClass($nightmodeClass);
            }
        }

        $viewResponse->set('region', $region);
        $viewResponse->getJs()->setProperty('region', $region);
    }

    /**
     * @param DateTimeZone $timeZone
     * @return string|null
     */
    protected function _getNightmodeClass(DateTimeZone $timeZone) {
        $date = new DateTime();
        $date->setTimezone($timeZone);
        $hour = (int) $date->format('H');

        if ($hour >= 2 && $hour <= 6) {
            return 'late-night-mode';
        }
        if ($hour >= 22 || $hour <= 6) {
            return 'night-mode';
        }

        return null;
    }
}
