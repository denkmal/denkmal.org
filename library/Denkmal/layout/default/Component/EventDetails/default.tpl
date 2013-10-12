{function event}
	<li class="previewEvent {if isset($class)}{$class}{/if}">
		<div class="event-inner">
			<span class="weekday">{date_weekday date=$event->getFrom()}</span>{date time=$event->getFrom()->getTimestamp()}
			{eventtext text=$event->getDescription()}
		</div>
	</li>
{/function}

{if $pastEvents->getCount() || $futureEvents->getCount() || $venue->getCoordinates()}

	{if $venue->getCoordinates()}
		<div class="map">
			{if $venue->getCoordinates()}
				<img src="{googlemaps_img coordinates=$venue->getCoordinates() width=300 height=300 scale=2}">
				<a href="https://maps.google.com/maps?saddr=&daddr={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" target="_blank">{translate 'In Google Maps öffnen'}</a>
			{else}
				no coordinates
			{/if}
		</div>
	{/if}

	{if $pastEvents->getCount() || $futureEvents->getCount()}
		<p class="more-events">{translate 'Weitere Events:'}</p>
		<ul class="previewEvents">
			{foreach $pastEvents as $pastEvent}
				{event event=$pastEvent class='pastEvent'}
			{/foreach}
			{foreach $futureEvents as $futureEvent}
				{event event=$futureEvent}
			{/foreach}
		</ul>
	{/if}
{else}
	<div class="noContent">
		{translate 'Keine zusätzlichen Informationen!'}
	</div>
{/if}
