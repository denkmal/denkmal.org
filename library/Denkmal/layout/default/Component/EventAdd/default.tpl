{form name='Denkmal_Form_EventAdd'}
{formField name='venue' label={translate 'Ort'}}
	<div class="venueDetails">
		{formField name='venueAddress' label={translate 'Adresse'}}
		{formField name='venueUrl' label={translate 'Webseite'}}
	</div>
	Event details
{formField name='date' label={translate 'Datum'}}
{formField name='fromTime' label={translate 'Beginn'}}
{formField name='untilTime' label={translate 'Ende'}}
{formField name='title' label={translate 'Titel'}}
{formField name='artists' label={translate 'KünstlerInnen'}}
{formField name='genres' label={translate 'Genres'}}
{formField name='urls' label={translate 'Webseiten'}}

{formAction action='Create' label={translate 'Hinzufügen'} alternatives="
	{button_link onclick="window.location='mailto:kontakt@denkmal.org?subject=Denkmal.org'" icon='mailbox' label={translate 'Kontakt'}}
"}
{/form}

