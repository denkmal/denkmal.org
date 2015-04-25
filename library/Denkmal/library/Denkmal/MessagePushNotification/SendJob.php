<?php

class Denkmal_MessagePushNotification_SendJob extends CM_Jobdistribution_Job_Abstract {

    protected function _execute(CM_Params $params) {
        /** @var Denkmal_Params $params */
        $message = $params->getMessage('message');

        $serviceManager = CM_Service_Manager::getInstance();
        $sender = $serviceManager->get('push-notification-sender', 'Denkmal_Push_Notification_Sender');
        $render = new CM_Frontend_Render(null, null, $serviceManager);
        $formatter = new Denkmal_MessagePushNotification_Formatter($render);

        $pushNotificationMessage = new Denkmal_Push_Notification_Message();
        $pushNotificationMessage->setExpires((new DateTime())->add(new DateInterval('PT6H')));
        $pushNotificationMessage->setData($formatter->getPushData($message));

        $subscriptionList = new Denkmal_Push_SubscriptionList_All();
        $sender->sendNotifications($subscriptionList->getItems(), $pushNotificationMessage);
    }
}
