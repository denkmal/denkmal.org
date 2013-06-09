<div class="event featured">
	{link icon="arrow-right" class="playButton navButton playAudio"}
	{link icon="map" class="mapButton navButton showMap"}
	<div class="event-content">
		{if $venue->getUrl()}
			<a href="{$venue->getUrl()}" class="location nowrap">{$venue->getName()}</a>
		{else}
			<span class="location nowrap">{$venue->getName()}</span>
		{/if}
		<span class="name nowrap">{$event->getDescription()}</span>
		<time class="time">
			<span class="icon icon-time"></span>
			{date_time date=$event->getFrom()}
		</time>
		<p>
			<span class="artists nowrap">Artists</span>
			<span class="genre nowrap">Genres</span>
		</p>
	</div>
</div>
