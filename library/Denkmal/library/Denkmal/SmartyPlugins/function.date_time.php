<?php

function smarty_function_date_time(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var DateTime $date */
    $date = $params['date'];

    $formatter = $render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'H:mm');
    return $formatter->format($date->getTimestamp());
}
