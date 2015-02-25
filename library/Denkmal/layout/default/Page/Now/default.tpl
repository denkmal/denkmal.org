{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {if $allowAdd}
    {component name='Denkmal_Component_MessageAdd'}
  {/if}
  {component name='Denkmal_Component_MessageList_Chat'}
{/block}
