<div class="song-content toggleNext">
  {component name="Denkmal_Component_SongPlayerButton" song=$song}
  {$song->getLabel()|escape}
</div>
<div class="song-edit toggleNext-content">
  {form name='Admin_Form_Song' song=$song}
  {formField name='label' label={translate 'Name'}}

  {formAction action='Save' label={translate 'Save'} alternatives="
    {button_link class='deleteSong warning' label={translate 'Delete'} icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
  "}
  {/form}
</div>
