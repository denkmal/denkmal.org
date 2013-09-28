<div class="event {if $event->getStarred()}featured{/if}">
	{if $event->getSong()}
		{component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
	{/if}
	{link icon="map" class="mapButton navButton showMap"}
	<div class="event-content">
		{if $venue->getUrl()}
			<a href="{$venue->getUrl()|escape}" class="location nowrap">{$venue->getName()|escape}</a>
		{else}
			<span class="location nowrap">{$venue->getName()|escape}</span>
		{/if}
		<span class="name nowrap">{eventtext text=$event->getTitle()}</span>
		<time class="time">
			<span class="icon icon-time"></span>
			{date_time date=$event->getFrom()}
		</time>
		<p class="meta">
			<span class="artists nowrap">{eventtext text=$event->getDescription()}</span>
			<span class="genre nowrap">Genres</span>
		</p>
	</div>
</div>
