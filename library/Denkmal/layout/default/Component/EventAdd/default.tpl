{form name='Denkmal_Form_EventAdd' region=$region}
  <div class="previewWrapper">
    <h3>{translate 'Preview'}:</h3>
    <div class="previewComponent"></div>
  </div>
  <div class="formWrapper">
    {formField name='venue' label={translate 'Venue'} placeholder=$venuePlaceholder}
    <div class="venueDetails">
      {formField name='venueAddress' label={translate 'Address'}}
      {formField name='venueUrl' label={translate 'Website'}}
    </div>
    {strip}
      {formField name='date' label={translate 'Date'}}
      {formField name='fromTime' label={translate 'Time'} placeholder={translate 'Start'} append={input name='untilTime' placeholder={translate 'End'}}}
    {/strip}
    {formField name='title' label={translate 'Title'} placeholder={translate 'Meet the Rich vol.8'}}
    {formField name='artists' label={translate 'Artists'} placeholder={translate 'Gregor Rellemer, The Savvy Ones, DJ John'}}
    {formField name='genres' label={translate 'Genres'} placeholder={translate 'Metal, Blues, Glam'}}
    {formField name='link' label={translate 'Event Link'} placeholder={translate 'https://facebook.com/event/12345'}}
    {formAction action='Create' label={translate 'Add Event'}}
  </div>
{/form}

<div class="formSuccess">
  <h2>{translate 'Event Has Been Added'}</h2>
  {translate 'Thank you. Event will be online within 24 hours.'}
  <div class="actions">
    {button_link class="addSimilar" label={translate 'Add Another Event'}}
    {button_link page="Denkmal_Page_Index" label={translate 'Back to Homepage'}}
  </div>
</div>

<div class="contact responsive-text">
  {translate 'Any questions or comments? Please contact us by e‑mail: {$emailAddress}'
  emailAddress={link href="mailto:{$region->getEmailAddress()}" label=$region->getEmailAddress()}}
</div>