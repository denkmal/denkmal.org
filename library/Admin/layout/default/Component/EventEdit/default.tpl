{capture name="songSuggestionList"}
  {if $songListSuggested->getCount() > 0}
    <div class="songSuggestionList">
      {foreach $songListSuggested as $song}
        {link label={$song->getLabel()} class="songSuggestion selectSong" data=[id => $song->getId(), label => $song->getLabel()]}
      {/foreach}
    </div>
  {/if}
{/capture}

<h2>{translate 'Edit Event'}</h2>
{form name='Admin_Form_Event' event=$event}
  <div class="preview">
    <h3>{translate 'Preview'}:</h3>
    {component name='Denkmal_Component_EventPreview' event=$event}
  </div>
  <div class="form-bundle form-bundle-1">
    {formField name='venue' label={translate 'Venue'}}
    {formField name='date' label={translate 'Date'}}
    {formField name='fromTime' label={translate 'Start'}}
    {formField name='untilTime' label={translate 'End'}}
  </div>
{formField name='description' label={translate 'Description'}}
  <div class="form-bundle form-bundle-2">
    {formField name='genres' label={translate 'Genres'}}
    {formField name='song' label={translate 'Song'} append=$smarty.capture.songSuggestionList}
  </div>
  <div class="form-bundle">
    {formField name='starred' text={translate 'Promote'} inlineLabel=true}
    {formField name='hidden' text={translate 'Hidden'}}
  </div>
{formAction action='Save' label={translate 'Save'} alternatives="
              {button_link class='deleteEvent warning' label={translate 'Delete'} icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
          "}
{/form}
<h3>Links</h3>
{component name='Admin_Component_EventLinkList' event=$event}

