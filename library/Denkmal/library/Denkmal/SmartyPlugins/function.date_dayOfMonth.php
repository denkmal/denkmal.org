<?php

function smarty_function_date_dayOfMonth(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var DateTime $date */
    $date = $params['date'];
    $timeZone = isset($params['timeZone']) ? $params['timeZone'] : null;
    $language = $render->getLanguage()->getAbbreviation();

    $pattern = 'dd';
    if ('de' === $language) {
        $pattern = 'd';
    }

    $formatter = $render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, $pattern, $timeZone);
    $dateString = $formatter->format($date->getTimestamp());

    if ('de' === $language) {
        $dateString .= '.';
    }

    return $dateString;
}
