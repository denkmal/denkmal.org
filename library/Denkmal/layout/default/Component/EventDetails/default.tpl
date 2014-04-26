{function event}
  <li class="previewEvent {if isset($class)}{$class}{/if}">
    <div class="eventDescription">
      <strong>{date_weekday date=$event->getFrom()} {date time=$event->getFrom()->getTimestamp()}</strong>
      <span class="event-details">
        <span class="description">{eventtext text=$event->getDescription()}</span>
      </span>
    </div>
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
  </li>
{/function}

{if $futureEvents->getCount() || $venue->getCoordinates()}
  {if $venue->getCoordinates()}
    <div class="map">
      <a href="https://maps.google.com/maps?saddr=&daddr={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" target="_blank">
        <img src="{googlemaps_img coordinates=$venue->getCoordinates() width=300 height=300 scale=2}">
      </a>
    </div>
  {/if}
  {if $futureEvents->getCount()}
    <p class="more-events">{translate 'Weitere Events:'}</p>
    <ul class="previewEvents">
      {foreach $futureEvents as $futureEvent}
        {event event=$futureEvent}
      {/foreach}
    </ul>
  {else}
    <div class="noContent">
      {translate 'Keine weiteren Events'}
    </div>
  {/if}
{else}
  <div class="noContent">
    {translate 'Keine zusätzlichen Informationen'}
  </div>
{/if}
