<?php

require_once CM_Util::getModulePath('CM') . 'library/CM/SmartyPlugins/function.date_time.php';

function smarty_function_event_time(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var $event Denkmal_Model_Event */
    $event = $params['event'];

    $date = $event->getFrom();
    $timeZone = $event->getTimeZone();

    $formatter = $render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'H:mm', $timeZone);
    list($hours, $minutes) = explode(':', $formatter->format($date->getTimestamp()));
    $result = $hours . 'h';
    if ($minutes !== '00') {
        $result .= $minutes;
    }

    return $result;
}
