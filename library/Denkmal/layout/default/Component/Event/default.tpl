{if $data}
	<div class="event featured">
		{link icon="play" class="playButton navButton playAudio"}
		{link icon="map" class="mapButton navButton showMap"}
		<div class="event-content">
			{if $data.url}
				<a href="{$data.url|escape}" class="location nowrap">{$data.venue|escape}</a>
			{else}
				<span class="location nowrap">{$data.venue|escape}</span>
			{/if}
			<span class="name nowrap">{eventtext text=$data.title}</span>
			<time class="time">
				<span class="icon icon-time"></span>
				{$data.from|escape}
			</time>
			<p class="meta">
				<span class="artists nowrap">{eventtext text=$data.description}</span>
				<span class="genre nowrap">Genres</span>
			</p>
		</div>
	</div>
{/if}
