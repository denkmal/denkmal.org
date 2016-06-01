<?php

require_once CM_Util::getModulePath('CM') . 'library/CM/SmartyPlugins/function.date_time.php';

function smarty_function_event_time(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var $event Denkmal_Model_Event */
    $event = $params['event'];

    $html = smarty_function_date_time(['date' => $event->getFrom(), 'timeZone' => $event->getTimeZone()], $template);
    if ($event->getUntil()) {
        $html .= ' - ';
        $html .= smarty_function_date_time(['date' => $event->getUntil(), 'timeZone' => $event->getTimeZone()], $template);
    }

    return $html;
}
