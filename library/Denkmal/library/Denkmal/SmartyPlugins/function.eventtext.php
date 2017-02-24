<?php

function smarty_function_eventtext($params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var Denkmal_Model_Event $event */
    $event = $params['event'];

    $eventFormatter = new Denkmal_EventFormatter_EventFormatter($render);
    return $eventFormatter->getHtml($event);
}
