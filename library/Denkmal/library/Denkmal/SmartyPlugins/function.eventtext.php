<?php

function smarty_function_eventtext($params, Smarty_Internal_Template $template) {
	/** @var CM_Render $render */
	$render = $template->smarty->getTemplateVars('render');
	$text = (string) $params['text'];

	$usertext = new CM_Usertext_Usertext($render);
	$usertext->addFilter(new CM_Usertext_Filter_Escape());
	$usertext->addFilter(new Denkmal_Usertext_Filter_Links());
	return $usertext->transform($text);
}
