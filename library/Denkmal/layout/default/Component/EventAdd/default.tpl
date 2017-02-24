{form name='Denkmal_Form_EventAdd' region=$region}
  <div class="formWrapper">
    {formField name='venue' label={translate 'Venue'} class="required" placeholder=$venuePlaceholder}
    <div class="venueDetails">
      {formField name='venueAddress' label={translate 'Address'}}
      {formField name='venueUrl' label={translate 'Website'}}
    </div>
    {strip}
    {formField name='date' label={translate 'Date'}}
    {formField name='fromTime' label={translate 'Time'} placeholder={translate 'Start'} class="required"
    append={input name='untilTime' placeholder={translate 'End (optional)'}}}
    {/strip}
    {formField name='title' label={translate 'Title'} placeholder={translate 'Meet the Rich vol.8 (optional)'} class="required"}
    {formField name='artists' label={translate 'Artists'} placeholder={translate 'Gregor Rellemer, The Savvy Ones, DJ John (optional)'}}
    {formField name='genres' label={translate 'Genres'} placeholder={translate 'Metal, Blues, Glam (optional)'}}
    {formField name='link' label={translate 'Event Link'} placeholder={translate 'https://myspace.com/meet-the-rich-vol8 (optional)'}}
    {formAction action='Create' label={translate 'Add'} alternatives=
    {button_link href="mailto:{$region->getEmailAddress()}" icon='message' label={translate 'Contact'}}
    }
  </div>
{/form}

<div class="formSuccess">
  <h2>{translate 'Event Has Been Added'}</h2>
  {translate 'Thank you. Event will be online within 24 hours.'}
  <div class="actions">
    {button_link class="addSimilar" label={translate 'Add Similar Event'}}
    {button_link page="Denkmal_Page_Index" theme="highlight" label={translate 'What\'s Up Today'}}
  </div>
</div>
