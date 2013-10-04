{function event}
	<li class="nowrap {if isset($class)}{$class}{/if}">
		{date time=$event->getFrom()->getTimestamp()}
		{eventtext text=$event->getDescription()}
	</li>
{/function}

<ul class="events">
	{foreach $pastEvents as $pastEvent}
		{event event=$pastEvent class='pastEvent'}
	{/foreach}

	{foreach $futureEvents as $futureEvent}
		{event event=$futureEvent}
	{/foreach}
</ul>
<div class="map">
	{if $venue->getCoordinates()}
		<img src="{googlemaps_img coordinates=$venue->getCoordinates() width=200 height=200}">
		<a href="https://maps.google.com/maps?saddr=&daddr={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" target="_blank">show on Maps</a>
	{else}
		no coordinates
	{/if}
</div>
