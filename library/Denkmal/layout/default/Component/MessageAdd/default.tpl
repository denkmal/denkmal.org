<div class="teaser">
  <div class="message-action">
    {button_link label={translate 'Was loift?!'} icon='chat-flash' class='showForm' theme='highlight'}
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

      <div class="venueNearby-overlay geo-waiting-visible">
        <div class="venueNearby-overlay-content geo-waiting-visible">
          <div class="spinner"></div>
          <p class="text">{translate 'Standort wird ermittelt…'}</p>
        </div>
      </div>

      <div class="venueNearby-overlay geo-failure-visible">
        <div class="venueNearby-overlay-content geo-failure-visible">
          <p class="text">
            {translate 'Standortbestimmung fehlgeschlagen.'}<br />
            {translate 'Du musst Dich in der Nähe eines Denkmal Venues befinden, und GPS aktivieren.'}
          </p>
          <div class="action">
            {button_link label={translate 'Standort bestimmen'} icon='location' class='retryLocation'}
          </div>
        </div>
      </div>

      <div class="geo-success-visible">
        {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
      </div>
      {formField name='tags' class='noLabel'}
      {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
      {formField name='image' class='noLabel'}

    </div>
  {formAction action='Create' icon='send' label={translate 'Senden'} alternatives={button_link label={translate 'Abbrechen'} class='hideForm'}}
  {/form}
</div>
