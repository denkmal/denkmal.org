<?php

function smarty_function_date_weekday(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');
    /** @var DateTime $date */
    $date = $params['date'];
    $timeZone = isset($params['timeZone']) ? $params['timeZone'] : null;
    $asHtml = isset($params['html']) ? $params['html'] : false;
    $pattern = ['eeeeee', 'eeee', 'dd'];

    $formatter = $render->getFormatterDate(IntlDateFormatter::NONE, IntlDateFormatter::NONE, implode(' ', $pattern), $timeZone);
    $dateString = $formatter->format($date->getTimestamp());
    $dateFormats = array_combine($pattern, explode(' ', $dateString));

    if ($asHtml) {
        $html = '';
        foreach ($dateFormats as $key => $value) {
            $html .= '<span class="date-' . $key . '">' . $value . '</span>';
        }
        return $html;
    }

    return $dateFormats['eeeeee'];
}
