<ul class="events">
	{foreach $pastEvents as $pastEvent}
		<li class="nowrap pastEvent">
			{date time=$pastEvent->getFrom()->getTimestamp()}
			{eventtext text=$pastEvent->getDescription()}
		</li>
	{/foreach}
	<hr>
	{foreach $futureEvents as $futureEvent}
		<li class="nowrap">
			{date time=$futureEvent->getFrom()->getTimestamp()}
			{eventtext text=$futureEvent->getDescription()}
		</li>
	{/foreach}
</ul>
<div class="map">
	{if $venue->getCoordinates()}
		{googlemaps_img coordinates=$venue->getCoordinates() size=['width' => 200, 'height' => 200]}
		<a href="https://maps.google.com/maps?saddr=&daddr={$venue->getCoordinates()->getLatitude()},{$venue->getCoordinates()->getLongitude()}" target="_blank">show on Maps</a>
	{else}
		no coordinates
	{/if}
</div>
