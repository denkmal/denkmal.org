<div class="event{if $event->getStarred()} starred{/if}">
  {if $event->getSong()}
    {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
  {/if}
  {if $allowDetails}
    {link icon="more" class="contextButton navButton showDetails"}
  {/if}
  <div class="eventDescription">
    <time class="time">
      <span class="icon icon-time"></span>
      {date_time date=$event->getFrom()}
    </time>
    <span class="event-header">
      {if $venue->getUrl()}
        <a href="{$venue->getUrl()|escape}" target="_blank" class="event-location nowrap">{$venue->getName()|escape}</a>
      {else}
        <span class="event-location nowrap">{$venue->getName()|escape}</span>
      {/if}
    </span>
    <span class="event-details">
      <span class="description">{eventtext text=$event->getDescription()}</span>
    </span>
  </div>
</div>
