{strip}
  {if $render->getSite()->hasRegion()}
    {translate '{$siteName} is an event calendar by locals. What\'s up in {$region} and how does it sound?' siteName=$render->getSite()->getName()|escape region=$render->getSite()->getRegion()->getName()|escape}
  {else}
    {translate '{$siteName} is an event calendar by locals. Explore your city\'s nightlife and get event updates and impressions by the crowd in real-time.' siteName=$render->getSite()->getName()|escape}
  {/if}
{/strip}
