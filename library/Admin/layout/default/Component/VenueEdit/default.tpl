{form name='Admin_Form_Venue' venue=$venue}
	{formField name='name' label={translate 'Name'}}
	{formField name='url' label={translate 'URL'}}
	{formField name='address' label={translate 'Adresse'}}
	{formField name='coordinates' label={translate 'Koordinaten'}}
	{formAction action='edit' label={translate 'Bearbeiten'}}
{/form}
