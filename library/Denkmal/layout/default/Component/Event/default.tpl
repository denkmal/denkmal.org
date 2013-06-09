{if $data}
	<div class="event featured">
		{link icon="arrow-right" class="playButton navButton playAudio"}
		{link icon="map" class="mapButton navButton showMap"}
		<div class="event-content">
			{if $data.url}
				<a href="{$data.url}" class="location nowrap">{$data.venue}</a>
			{else}
				<span class="location nowrap">{$data.venue}</span>
			{/if}
			<span class="name nowrap">{eventtext text=$data.description}</span>
			<time class="time">
				<span class="icon icon-time"></span>
				{$data.from}
			</time>
			<p>
				<span class="artists nowrap">Artists</span>
				<span class="genre nowrap">Genres</span>
			</p>
		</div>
	</div>
{/if}
