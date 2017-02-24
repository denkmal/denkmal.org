<div class="event{if $event->getHidden()} hidden{/if}{if $event->getStarred()} starred{/if} {if $allowEditing}editEvent{/if}">
  <div class="eventDescription">
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
    <time class="time">
      <span class="icon icon-time"></span>
      {event_time event=$event}
    </time>
    <span class="event-header">
      <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="event-location {if $venue->getIgnore()}ignored{/if} {if $venue->getSuspended()}suspended{/if} nowrap">{$venue->getName()|escape}</a>
      {if $venue->getUrl()}
        <a href="{$venue->getUrl()|escape}"><span class="icon icon-pop-out"></span></a>
      {/if}
      <time class="currentDate">{date_full date=$event->getFrom() timeZone=$event->getTimeZone()}</time>
    </span>
    <div class="event-details">
      {if $eventDuplicates->getCount()}
        <span class="icon icon-error"></span>
      {/if}
      <span class="description">{eventtext event=$event}</span>
    </div>
  </div>
</div>
