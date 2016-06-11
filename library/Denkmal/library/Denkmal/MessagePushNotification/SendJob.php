<?php

class Denkmal_MessagePushNotification_SendJob extends CM_Jobdistribution_Job_Abstract {

    protected function _execute(CM_Params $params) {
        /** @var Denkmal_Params $params */
        $message = $params->getMessage('message');
        $region = $message->getVenue()->getRegion();
        $site = Denkmal_Site_Region_Abstract::findSiteByRegion($region);
        if (!$site) {
            return;
        }
        $subscriptionList = new Denkmal_Push_SubscriptionList_Site($site);

        $serviceManager = CM_Service_Manager::getInstance();
        /** @var Denkmal_Push_Notification_Sender $sender */
        $sender = $serviceManager->get('push-notification-sender', 'Denkmal_Push_Notification_Sender');

        $environment = new CM_Frontend_Environment($site);
        $render = new CM_Frontend_Render($environment, null, $serviceManager);
        $formatter = new Denkmal_MessagePushNotification_Formatter($render);

        $pushNotificationMessage = new Denkmal_Push_Notification_Message();
        $pushNotificationMessage->setExpires((new DateTime())->add(new DateInterval('PT6H')));
        $pushNotificationMessage->setData($formatter->getPushData($message));

        $sender->sendNotifications($subscriptionList->getItems(), $pushNotificationMessage);
    }
}
