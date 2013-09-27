<div class="event">
	{if $song = $event->getSong()}
		{link icon="arrow-right" class="playButton navButton playAudio"}
	{/if}
	{link icon="arrow-down" class="editEvent"}
	<div class="event-content">
		<a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="venue nowrap">{$venue->getName()|escape}</a>
		<time class="time">
			{$event->getFrom()->format('H:i')}
		</time>
		{if $event->getUntil()}
			-
			<time class="time">
				{$event->getUntil()->format('H:i')}
			</time>
		{/if}
		{if $event->getTitle()}
			<span class="title nowrap">{eventtext text=$event->getTitle()}</span>
		{/if}
		<span class="description nowrap">{eventtext text=$event->getDescription()}</span>
	</div>
</div>
