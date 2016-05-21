<div class="teaser">
  <div class="message-action">
    {button_link label={translate 'Write Something!'} icon='chat-flash' class='showForm' theme='highlight'}
  </div>

  <div class="account">
    {if $viewer}
      {button_link theme='transparent' icon='hipster' label=$viewer->getDisplayName()|escape page='Denkmal_Page_Account'}
    {else}
      {button_link theme='transparent' page='Denkmal_Page_Login' label={translate 'Login'}}
    {/if}
  </div>
</div>

{form name='Denkmal_Form_Message'}
  <div class="localization">

    <div class="geo-success-visible">
      {formField name='venue' class='noLabel' labelPrefix={translate 'Venue'}}
    </div>
    {formField name='tags' class='noLabel'}
    {formField name='text' class='noLabel' placeholder={translate 'Your message'}}
    {formField name='image' class='noLabel'}

    <div class="venueNearby-overlay geo-waiting-visible">
      <div class="venueNearby-overlay-content geo-waiting-visible">
        <div class="spinner"></div>
        <p class="info">{translate 'Searching location'}…</p>
      </div>
    </div>

    <div class="venueNearby-overlay geo-failure-visible">
      <div class="venueNearby-overlay-content geo-failure-visible">
        <div class="info">
          <p class="warning">{translate 'No venue at your current location.'}</p>
          <small>{translate 'You have to be nearby a Denkmal venue to use Denkmal Now. Make sure Location Services are allowed and activated.'}</small>
        </div>
        <div class="action">
          {button_link label={translate 'Find Venue'} icon='location' class='retryLocation'}
        </div>
      </div>
    </div>

  </div>
{formAction action='Create' icon='send' label={translate 'Send'} alternatives={button_link label={translate 'Cancel'} class='hideForm'}}
{/form}
