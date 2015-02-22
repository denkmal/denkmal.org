{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {component name='Denkmal_Component_MessageAdd'}

  {component name='Denkmal_Component_MessageList_All'}
{/block}
