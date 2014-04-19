{if $event->getSong()}
  <div class='songDetails nowrap'>
    <span class="icon icon-music"></span><span class="label"></span>
  </div>
{/if}
<div class="event{if $event->getStarred()} starred{/if}">
  {if $event->getSong()}
    {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
  {/if}
  {if $allowDetails}
    {link icon="menu-micro" class="contextButton navButton showDetails"}
  {/if}
  <div class="eventDescription">
    <time class="time">
      <span class="icon icon-time"></span>
      {date_time date=$event->getFrom()}{if $event->getUntil()} - {date_time date=$event->getUntil()}{/if}
    </time>
    {if $venue->getUrl()}
      <a href="{$venue->getUrl()|escape}" target="_blank" class="event-location nowrap">{$venue->getName()|escape}</a>
    {else}
      <span class="event-location nowrap">{$venue->getName()|escape}</span>
    {/if}
    <span class="event-details">{if $event->getTitle()}<span class="title">{eventtext text=$event->getTitle()}</span>{/if}
      <span class="description">{eventtext text=$event->getDescription()}</span>
    </span>
  </div>
</div>
