{if $event->getSong()}
  <div class='songDetails nowrap'>
    <span class="icon icon-music"></span>{$event->getSong()->getLabel()|escape}
  </div>
{/if}
<div class="event{if $event->getStarred()} starred{/if}">
  {if $event->getSong()}
    {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
  {/if}
  {if $allowDetails}
    {link icon="menu-micro" class="contextButton navButton showDetails"}
  {/if}
  <div class="event-content">
    <time class="time">
      <span class="icon icon-time"></span>
      {date_time date=$event->getFrom()}{if $event->getUntil()} - {date_time date=$event->getUntil()}{/if}
    </time>
    {if $venue->getUrl()}
      <a href="{$venue->getUrl()|escape}" class="event-location nowrap">{$venue->getName()|escape}</a>
    {else}
      <span class="event-location nowrap">{$venue->getName()|escape}</span>
    {/if}
    <p class="event-details">{if $event->getTitle()}<span class="title">{eventtext text=$event->getTitle()}</span>{/if}
      <span class="description">{eventtext text=$event->getDescription()}</span></p>
  </div>
</div>
