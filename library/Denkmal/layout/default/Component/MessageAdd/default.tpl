<div class="teaser">
  {button_link label={translate 'Was loift?!'} icon='chat' class='showForm' theme='highlight'}
</div>

<div class="form">
  {form name='Denkmal_Form_Message'}
  {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
  {formField name='tags' class='noLabel'}
  {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
  {formAction action='Create' icon='send' label={translate 'Senden'} alternatives={button_link label={translate 'Abbrechen'} class='hideForm'}}
  {/form}
</div>
