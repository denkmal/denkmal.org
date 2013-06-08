{form name='Admin_Form_Venue' venue=$venue}
	{formField name='name' label={translate 'Name'}}
	{formField name='url' label={translate 'URL'}}
	{formField name='address' label={translate 'Address'}}
	{formField name='coordinates' label={translate 'Coordinates'}}
	{if $venue}
		{formAction action='edit' label={translate 'Edit'}}
	{else}
		{formAction action='add' label={translate 'Add'}}
	{/if}
{/form}
