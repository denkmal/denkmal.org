{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}
  {menu name="main" class="menu-pills" depth=1}
{/block}

{block name='content-main'}
  {component name='Admin_Component_LogList' type=$type aggregate=$aggregate page=$page urlPage='Admin_Page_Log' urlParams=['type' => $type, 'aggregate' => $aggregate]}
{/block}
