{form name='Denkmal_Form_EventAdd'}
	{formField name='venue' label={translate 'Venue'}}
	<div class="venueDetails">
		{formField name='venueAddress' label={translate 'Address'}}
		{formField name='venueUrl' label={translate 'Website'}}
	</div>

	Event details
	{formField name='date' label={translate 'From'}}
	{formField name='fromTime' label={translate 'Time'}}
	{formField name='untilTime' label={translate 'Until'}}
	{formField name='title' label={translate 'Title'}}
	{formField name='artists' label={translate 'Artists'}}
	{formField name='genres' label={translate 'Genres'}}
	{formField name='urls' label={translate 'Websites'}}

	{formAction action='create' label={translate 'Add'}}
{/form}
