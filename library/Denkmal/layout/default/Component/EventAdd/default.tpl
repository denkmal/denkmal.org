{form name='Denkmal_Form_EventAdd'}
{formField name='venue' label={translate 'Ort'} class="required" placeholder={translate 'Agora Bar'}}
	<div class="venueDetails">
		{formField name='venueAddress' label={translate 'Adresse'}}
		{formField name='venueUrl' label={translate 'Webseite'}}
	</div>
{formField name='date' label={translate 'Datum'}}
{formField name='fromTime' label={translate 'Zeit'} placeholder={translate 'Beginn'} class="required"
append={input name='untilTime' placeholder={translate 'Ende (optional)'}}}
{formField name='title' label={translate 'Titel'} placeholder={translate 'Meet the Rich vol.8'} class="required"}
{formField name='artists' label={translate 'KünstlerInnen'} placeholder={translate 'Gregor Rellemer, The Savvy Ones, DJ John (optional)'}}
{formField name='genres' label={translate 'Genres'} placeholder={translate 'Metal, Blues, Glam (optional)'}}
{formField name='urls' label={translate 'Webseiten'} placeholder={translate 'www.myspace.com/ich (optional)'}}

{formAction action='Create' label={translate 'Hinzufügen'} alternatives="
		{button_link onclick="window.open('mailto:kontakt@denkmal.org')" icon='mailbox' label={translate 'Kontakt'}}
"}
{/form}
