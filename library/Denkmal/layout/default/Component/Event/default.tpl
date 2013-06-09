<div class="event featured">
	{link icon="arrow-right" class="playButton navButton playAudio"}
	{link icon="map" class="mapButton navButton showMap"}
	<div class="event-content">
		<a href="javascript:;" class="location nowrap">
			{$event.0.location}
		</a>
		<span class="name nowrap">{$event.2.name}</span>
		<time class="time">
			<span class="icon icon-time"></span>
			{$event.1.time}
		</time>
		<p>
			<span class="artists nowrap">{$event.3.bands}</span>
			<span class="genre nowrap">{$event.4.genre}</span>
		</p>
	</div>
</div>
