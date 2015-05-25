<?php

function smarty_function_eventtext($params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    $text = (string) $params['text'];

    $eventFormatter = new Denkmal_Usertext_EventFormatter($render);
    return $eventFormatter->transform($text);
}
