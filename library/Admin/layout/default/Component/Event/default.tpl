<div class="event{if $event->getHidden()} hidden{/if}{if $event->getStarred()} starred{/if}">
  <div class="eventDescription {if $allowEditing}toggleNext{/if}">
    {if $event->getSong()}
      {component name="Denkmal_Component_SongPlayerButton" song=$event->getSong()}
    {/if}
    <time class="time">
      <span class="icon icon-time"></span>
      {event_time event=$event}
    </time>
    <span class="event-header">
      <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="event-location toggleNext-excluded {if $venue->getIgnore()}ignored{/if} {if $venue->getSuspended()}suspended{/if} nowrap">{$venue->getName()|escape}</a>
      {if $venue->getUrl()}
        <a href="{$venue->getUrl()|escape}" class="toggleNext-excluded"><span class="icon icon-pop-out"></span></a>
      {/if}
      <time class="currentDate">{date_full date=$event->getFrom() timeZone=$event->getTimeZone()}</time>
    </span>
    <div class="event-details">
      {if $eventDuplicates->getCount()}
        <span class="icon icon-error"></span>
      {/if}
      <span class="description">{eventtext text=$event->getDescription()}</span>
    </div>
  </div>

  {if $allowEditing}
    <div class="event-edit toggleNext-content">
      {if $eventDuplicates->getCount()}
        <div class="info info-duplicate">
          <span class="icon icon-error"></span>
          {translate 'Selected day already contains {$count} event(s) for {$venue}.' count=$eventDuplicates->getCount() venue="<span class=\"venue\">{$venue->getName()|escape}</span>"}
        </div>
      {/if}

      {capture name="songSuggestionList"}
        {if $songListSuggested->getCount() > 0}
          <div class="songSuggestionList">
            {foreach $songListSuggested as $song}
              {link label={$song->getLabel()} class="songSuggestion selectSong" data=[id => $song->getId(), label => $song->getLabel()]}
            {/foreach}
          </div>
        {/if}
      {/capture}

      {capture name="linkSuggestionList"}
        {if $linkListSuggested->getCount() > 0}
          <div class="linkSuggestionList">
            {foreach $linkListSuggested as $link}
              {link label={$link->getLabel()} class="linkSuggestion selectLink" data=[label => $link->getLabel()]}
            {/foreach}
          </div>
        {/if}
      {/capture}

      {form name='Admin_Form_Event' event=$event}
      {formField name='venue' label={translate 'Venue'}}
      {formField name='date' label={translate 'Date'}}
      {formField name='fromTime' label={translate 'Start'}}
      {formField name='untilTime' label={translate 'End'}}
      {formField name='description' label={translate 'Description'} append=$smarty.capture.linkSuggestionList}
      {formField name='song' label={translate 'Song'} append=$smarty.capture.songSuggestionList}
      {formField name='starred' label={translate 'Starred'}}
      {formField name='hidden' label={translate 'Hidden'}}
      {formAction action='Save' label={translate 'Save'} alternatives="
              {button_link class='deleteEvent warning' label={translate 'Delete'} icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
          "}
      {/form}
    </div>
  {/if}
</div>
