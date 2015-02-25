{extends file=$render->getLayoutPath('Component/MessageList_Abstract/default.tpl')}

{block name='before'}
  {if $venue}
    <div class="filter-panel">
      {translate 'Filter'}:
      <a class="filter" href="{linkUrl page='Denkmal_Page_Now'}">
        <span class="icon icon-close remove"></span>
        {$venue->getName()|escape}
      </a>
    </div>
  {/if}
{/block}
