<?php

function smarty_function_date_weekday(array $params, Smarty_Internal_Template $template) {
	/** @var CM_Render $render */
	$render = $template->smarty->getTemplateVars('render');
	/** @var DateTime $date */
	$date = $params['date'];

	$formatter = new IntlDateFormatter($render->getLocale(), IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'eee');
	$weekday = $formatter->format($date->getTimestamp());
	return substr($weekday, 0, 2);
}
