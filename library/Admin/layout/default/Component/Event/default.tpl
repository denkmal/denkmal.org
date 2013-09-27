<div class="event">
	<div class="event-content toggleNext">
		{if $song = $event->getSong()}
			{link icon="arrow-right" class="playButton navButton playAudio"}
		{/if}
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
	<div class="event-edit toggleNext-content">
		{form name='Admin_Form_Event' event=$event}
			{formField name='venue' label={translate 'Ort'}}
			{formField name='date' label={translate 'Datum'}}
			{formField name='fromTime' label={translate 'Beginn'}}
			{formField name='untilTime' label={translate 'Ende'}}
			{formField name='title' label={translate 'Titel'}}
			{formField name='description' label={translate 'Beschreibung'}}
			{formField name='activate' label={translate 'Freischalten'}}

			{formAction action='Save' label={translate 'Speichern'} alternatives="
				{formAction action='Delete' label={translate 'Löschen'}}

				{if $event->getHidden()}
					{formAction action='Show' label={translate 'Anzeigen'}}
				{else}
					{formAction action='Hide' label={translate 'Ausblenden'}}
				{/if}
			"}
		{/form}
	</div>
</div>
