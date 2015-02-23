<div class="teaser">
  <div class="formField noLabel">
    {button_link label={translate 'Nachricht schreiben'} icon='chat' class='showForm'}
  </div>
</div>

<div class="form">
  {form name='Denkmal_Form_Message'}
  {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
  {formField name='tags' class='noLabel'}
  {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
  {formAction action='Create' icon='chat' label={translate 'Los!'} alternatives={button_link label={translate 'Abbrechen'} class='hideForm'}}
  {/form}
</div>
