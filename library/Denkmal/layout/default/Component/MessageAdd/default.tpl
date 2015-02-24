<div class="teaser">
  <div class="message-action">
    {button_link label={translate 'Was loift?!'} icon='chat' class='showForm' theme='highlight'}
  </div>

  <div class="account">
    {if $viewer}
      {button_link icon='hipster' theme='transparent' label=$viewer->getDisplayName() page='Denkmal_Page_Account'}
    {else}
      {button_link icon='hipster' theme='transparent' page='Denkmal_Page_Login'}
    {/if}
  </div>
</div>

<div class="form">
  {form name='Denkmal_Form_Message'}
  {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
  {formField name='tags' class='noLabel'}
  {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
  {formField name='image' class='noLabel'}
  {formAction action='Create' icon='send' label={translate 'Senden'} alternatives={button_link label={translate 'Abbrechen'} class='hideForm'}}
  {/form}
</div>
