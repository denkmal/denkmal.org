<?php

function smarty_function_date_full(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var DateTime $date */
    $date = $params['date'];
    $timeZone = isset($params['timeZone']) ? $params['timeZone'] : null;

    $formatterWeekday = $render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'eee', $timeZone);
    $stringWeekday = $formatterWeekday->format($date->getTimestamp());

    $formatterDate = $render->getFormatterDate(IntlDateFormatter::SHORT, IntlDateFormatter::NONE, null, $timeZone);
    $stringDate = $formatterDate->format($date->getTimestamp());

    return substr($stringWeekday, 0, 2) . ' ' . $stringDate;
}
