{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Admin_Component_LogList' type=$type aggregate=$aggregate page=$page urlPage='Admin_Page_Log' urlParams=['type' => $type, 'aggregate' => $aggregate]}
{/block}
