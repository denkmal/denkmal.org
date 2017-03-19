<?php

class Denkmal_View_Document extends CM_View_Document {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        parent::prepare($environment, $viewResponse);

        /** @var Denkmal_Site_Default $site */
        $site = $environment->getSite();
        $appSettings = new Denkmal_App_Settings();
        $timeZone = null;
        if ($site->hasRegion()) {
            $timeZone = $site->getRegion()->getTimeZone()->getName();
        }

        $viewResponse->getJs()->setProperty('dayOffset', $appSettings->getDayOffset());
        $viewResponse->getJs()->setProperty('timeZone', $timeZone);
    }

}
