<div class="venue {if $venue->getIgnore()}hidden{/if}">
	<div class="venue-content toggleNext">
		<a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="venue nowrap">{$venue->getName()|escape}</a>
	</div>
	<div class="venue-edit toggleNext-content">
		{form name='Admin_Form_Venue' venue=$venue}
			{formField name='name' label={translate 'Name'}}
			{formField name='url' label={translate 'URL'}}
			{formField name='address' label={translate 'Adresse'}}
			{formField name='coordinates' label={translate 'Koordinaten'}}
			{formField name='ignore' label={translate 'Scraper ignorieren'}}
			{formAction action='Save' label={translate 'Speichern'} alternatives="
				{button action='Delete' label={translate 'Löschen'} theme='danger' event='clickConfirmed'}
			"}
		{/form}

		{component name='Admin_Component_VenueAliasList' venue=$venue}
	</div>
</div>
