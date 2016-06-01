<p>
  {translate 'A new event for {$venue} has been added:' venue=$venue->getName()|escape}
</p><p>
  {date_full date=$event->getFrom() timeZone=$event->getTimeZone()}
  {event_time event=$event}
  <br />
  <a href="{linkUrl page=Admin_Page_Venue venue=$venue->getId()}">{$event->getDescription()|escape}</a>
</p>
