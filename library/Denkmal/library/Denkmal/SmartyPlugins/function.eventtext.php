<?php

function smarty_function_eventtext($params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var Denkmal_Model_Event $event */
    $event = $params['event'];
    $plainText = !empty($params['plainText']);

    $eventFormatter = new Denkmal_EventFormatter_EventFormatter($render);
    if ($plainText) {
        return $eventFormatter->getText($event);
    } else {
        return $eventFormatter->getHtml($event);
    }
}
