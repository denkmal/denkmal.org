{extends file=$render->getLayoutPath('Page/Abstract/meta-description.tpl')}

{block name='everything'}
  {if $event}
    {eventtext event=$event plainText=true}
  {else}
    {$smarty.block.parent}
  {/if}
{/block}
