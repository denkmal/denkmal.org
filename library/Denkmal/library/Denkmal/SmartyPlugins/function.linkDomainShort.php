<?php
require_once CM_Util::getModulePath('CM') . 'library/CM/SmartyPlugins/function.link.php';

function smarty_function_linkDomainShort(array $params, Smarty_Internal_Template $template) {
    /** @var CM_Frontend_Render $render */
    $render = $template->smarty->getTemplateVars('render');

    $page = $params['page'];
    unset($params['page']);

    $href = $render->getUrlPage($page, $params);
    $params['href'] = $href;
    $params['label'] = preg_replace('#^https?://(www\.)?#', '', $href);

    return smarty_function_link($params, $template);
}
