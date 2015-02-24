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
    <div class="form-fields">
      <div class="venueNearby-waiting-overlay geo-waiting-visible">
        <div class="venueNearby-waiting-info">
          <div class="spinner"></div>
          <p class="text">{translate 'Standort wird ermittelt…'}</p>
        </div>
      </div>
      <div class="geo-success-visible">
        {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
      </div>
      <div class="geo-failure-visible">
        Failure
      </div>
      {formField name='tags' class='noLabel'}
      {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
      {formField name='image' class='noLabel'}
    </div>
  {formAction action='Create' icon='send' label={translate 'Senden'} alternatives={button_link label={translate 'Abbrechen'} class='hideForm'}}
  {/form}
</div>
