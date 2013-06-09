<div class="event featured">
	{link icon="arrow-right" class="playButton navButton playAudio"}
	{link icon="map" class="mapButton navButton showMap"}
	<div class="event-content">
		<a href="javascript:;" class="location nowrap">
			{$event->getVenue()->getName()}
		</a>
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
