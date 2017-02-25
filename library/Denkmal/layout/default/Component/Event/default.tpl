<div class="event {if $event->getStarred()} starred{/if}">
  <div class="event-star">
    {resourceFileContent path='img/star.svg'}
  </div>
  <div class="event-description">
    <div class="venue nowrap">
      {$venue->getName()|escape}
    </div>
    <div class="details">
      {eventtext event=$event}{if $event->getSong()}<span class="icon icon-music"></span>{/if}
    </div>
  </div>
  <div class="event-context">
    <time class="time">
      {event_time event=$event}
    </time>
    {*<div class="share">*}
      {*<span class="icon icon-share"></span>*}
    {*</div>*}
  </div>
</div>
