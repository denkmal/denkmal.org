{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Admin_Component_LogList' level=$level aggregate=$aggregate page=$page urlPage='Admin_Page_Log' urlParams=['level' => $level, 'aggregate' => $aggregate]}
{/block}
