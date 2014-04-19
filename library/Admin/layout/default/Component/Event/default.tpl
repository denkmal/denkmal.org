<div class="event{if $event->getHidden()} hidden{/if}{if $event->getStarred()} starred{/if}">
  <div class="eventDescription toggleNext">
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
    <time class="time">
      <span class="icon icon-time"></span>
      {date_time date=$event->getFrom()}{if $event->getUntil()} - {date_time date=$event->getUntil()}{/if}
    </time>
    <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="event-location {if $venue->getIgnore()}ignored{/if} nowrap">{$venue->getName()|escape}</a>
    <time class="currentDate"><span class="weekday">{date_weekday date=$event->getFrom()}</span>{date time=$event->getFrom()->getTimestamp()}</time>
    <p class="event-details">
      {if $eventDuplicates->getCount()}
        <span class="icon icon-info"></span>
      {/if}
      {if $event->getTitle()}<span class="title">{eventtext text=$event->getTitle()}</span>{/if}
      <span class="description">{eventtext text=$event->getDescription()}</span></p>
  </div>
  <div class="event-edit toggleNext-content">
    {capture name="songSuggest"}
      {if $songListSuggested && $songListSuggested->getCount() > 0}
        <div class="songSuggest">
          {translate 'Vorschlag'}:
          {foreach $songListSuggested as $song}
            {link label={$song->getLabel()} class="selectSong" data=[id => $song->getId(), label => $song->getLabel()]},
          {/foreach}
        </div>
      {/if}
    {/capture}

    {if $eventDuplicates->getCount()}
      <div class="info info-duplicate">
        <span class="icon icon-info"></span>
        {translate 'Es sind bereits {$count} Event(s) an diesem Tag für {$venue} eingetragen.' count=$eventDuplicates->getCount() venue="<span class=\"venue\">{$venue->getName()|escape}</span>"}
      </div>
    {/if}

    {form name='Admin_Form_Event' event=$event}
    {formField name='venue' label={translate 'Ort'}}
    {formField name='date' label={translate 'Datum'}}
    {formField name='fromTime' label={translate 'Beginn'}}
    {formField name='untilTime' label={translate 'Ende'}}
    {formField name='title' label={translate 'Titel'}}
    {formField name='description' label={translate 'Beschreibung'}}
    {formField name='song' label={translate 'Lied'} append=$smarty.capture.songSuggest}
    {formField name='starred' label={translate 'Starred'}}
    {formAction action='Save' label={translate 'Speichern'} alternatives="
				{button action='Delete' label={translate 'Löschen'} icon='delete' iconConfirm='delete-confirm' class='warning deleteAffiliate' data=['click-confirmed' => true]}
				{if $event->getHidden()}
					{button action='Show' label={translate 'Anzeigen'}}
				{else}
					{button action='Hide' label={translate 'Ausblenden'}}
				{/if}
			"}
    {/form}
  </div>
</div>
