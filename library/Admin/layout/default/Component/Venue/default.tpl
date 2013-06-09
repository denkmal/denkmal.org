{form name='Admin_Form_Venue' venue=$venue}
	{formField name='name' label={translate 'Name'}}
	{formField name='url' label={translate 'URL'}}
	{formField name='address' label={translate 'Adresse'}}
	{formField name='coordinates' label={translate 'Koordinaten'}}
	{if $venue}
		{formAction action='edit' label={translate 'Bearbeiten'}}
	{else}
		{formAction action='add' label={translate 'Hinzufügen'}}
	{/if}
{/form}
