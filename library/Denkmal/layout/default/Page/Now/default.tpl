{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  {if $allowAdd}
    {component name='Denkmal_Component_MessageAdd'}
  {/if}

  {if $venue}
    <div class="filter-panel">
      {translate 'Filter'}:
      <a class="filter" href="{linkUrl page='Denkmal_Page_Now'}">
        <span class="icon icon-close remove"></span>
        {$venue->getName()|escape}
      </a>
    </div>
  {/if}

  {if $venue}
    {component name='Denkmal_Component_MessageList_Venue' venue=$venue}
  {else}
    {component name='Denkmal_Component_MessageList_All'}
  {/if}
{/block}
