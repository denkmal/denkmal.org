<div class="event editEvent{if $event->getHidden()} hidden{/if}">
  <div class="event-description">
    <div class="venue nowrap">
      <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="venue-link nowrap {if $venue->getIgnore()}ignored{/if} {if $venue->getSuspended()}suspended{/if} nowrap">{$venue->getName()|escape}</a>
      {if $venue->getUrl()}
        <a href="{$venue->getUrl()|escape}"><span class="icon icon-pop-out"></span></a>
      {/if}
      <time class="date">{date_full date=$event->getFrom() timeZone=$event->getTimeZone()}</time>
    </div>
    <div class="details">
      {eventtext event=$event}{if $event->getStarred()}<span class="promoted" title="{translate 'Event promoted by {$siteName}' siteName=$render->getSiteName()}">♡</span>{/if}{if $event->getSong()}<span class="music">♫</span>{/if}
    </div>
  </div>
  <div class="event-context">
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
    {if $eventDuplicates->getCount()}
      <span class="icon icon-error"></span>
    {/if}
  </div>
</div>
{component name='Admin_Component_EventEdit' event=$event}
