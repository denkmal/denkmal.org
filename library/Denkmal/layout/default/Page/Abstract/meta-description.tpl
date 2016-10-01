{strip}
  {if $render->getSite()->hasRegion()}
    {translate ".meta.description.{$render->getSite()->getRegion()->getSlug()}" siteName=$render->getSite()->getName()|escape region=$render->getSite()->getRegion()->getName()|escape}
  {else}
    {translate '.meta.description' siteName=$render->getSite()->getName()|escape}
  {/if}
{/strip}
