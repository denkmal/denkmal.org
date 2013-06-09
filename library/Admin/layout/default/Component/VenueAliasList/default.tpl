<ul>
	{foreach $venueAliasList as $venueAlias}
		<li>
			{$venueAlias->getName()|escape}
		</li>
	{/foreach}

	{form name='Admin_Form_VenueAlias' venue=$venue}
		{formField name='name' label={translate 'Name'}}
		{formAction action='add' label={translate 'Hinzufügen'}}
	{/form}
</ul>
