<div class="teaser">
  <div class="message-action">
    {button_link label={translate 'Write Something!'} icon='chat-flash' class='showForm' theme='highlight'}
  </div>

  <div class="account">
    {if $viewer}
      {button_link label=$viewer->getDisplayName()|escape icon='hipster' theme='transparent' label=$viewer->getDisplayName() page='Denkmal_Page_Account'}
    {else}
      {button_link icon='hipster' theme='transparent' page='Denkmal_Page_Login'}
    {/if}
  </div>
</div>

<div class="form">
  {form name='Denkmal_Form_Message'}
    <div class="form-fields">

      <div class="geo-success-visible">
        {formField name='venue' class='noLabel' labelPrefix={translate 'Venue'}}
      </div>
      {formField name='tags' class='noLabel'}
      {formField name='text' class='noLabel' placeholder={translate 'Your message'}}
      {formField name='image' class='noLabel'}

      <div class="venueNearby-overlay geo-waiting-visible">
        <div class="venueNearby-overlay-content geo-waiting-visible">
          <div class="spinner"></div>
          <p class="text">{translate 'Searching location'}…</p>
        </div>
      </div>

      <div class="venueNearby-overlay geo-failure-visible">
        <div class="venueNearby-overlay-content geo-failure-visible">
          <p class="text">
            {translate 'No venue at your current location.'}<br />
            {translate 'You have to be nearby a Denkmal venue to use Denkmal Now. Make sure Location Services are allowed and activated.'}
          </p>
          <div class="action">
            {button_link label={translate 'Find Venue'} icon='location' class='retryLocation'}
          </div>
        </div>
      </div>

    </div>
  {formAction action='Create' icon='send' label={translate 'Send'} alternatives={button_link label={translate 'Cancel'} class='hideForm'}}
  {/form}
</div>
