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
      {date_time date=$event->getFrom() timeZone=$event->getTimeZone()}
    </time>
    <span class="event-header nowrap">
      {if $venue->getUrl()}
        <a href="{$venue->getUrl()|escape}" target="_blank" class="event-location">{$venue->getName()|escape}</a>
      {else}
        <span class="event-location">{$venue->getName()|escape}</span>
      {/if}
    </span>
    <span class="event-details">
      <span class="description">
        {eventtext event=$event}
      </span>
    </span>
  </div>
</div>
