{if $event}
  {$event->getVenue()->getName()}, {event_time event=$event}
{/if}