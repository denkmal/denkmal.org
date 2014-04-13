<div class="event{if $event->getHidden()} hidden{/if}{if $event->getStarred()} starred{/if}">
  <div class="event-content toggleNext">
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
    <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="venue nowrap">{$venue->getName()|escape}</a>
    <div class="date-time">
      <time class="date">{date time=$event->getFrom()->getTimestamp()}</time>
      -
      <time class="time">
        {date_time date=$event->getFrom()}
      </time>
      {if $event->getUntil()}
        -
        <time class="time">
          {date_time date=$event->getUntil()}
        </time>
      {/if}
    </div>
    <div class="description">
      {if $event->getTitle()}
        <span class="title">{eventtext text=$event->getTitle()}</span>
      {/if}
      {eventtext text=$event->getDescription()}
    </div>
  </div>
  <div class="event-edit toggleNext-content">
    {capture name="songSuggest"}
      {if $songListSuggested}
      <div class="songSuggest">
        {translate 'Vorschlag'}:
        {foreach $songListSuggested as $song}
          {link label={$song->getLabel()} class="selectSong" data=[id=>{$song->getId()}, label=>{$song->getLabel()}]},
        {/foreach}
       </div>
      {/if}
    {/capture}

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
