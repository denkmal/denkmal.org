<ul>
	{foreach $venueAliasList as $venueAlias}
		<li>
			{$venueAlias->getName()|escape}
		</li>
	{/foreach}

	{form name='Admin_Form_VenueAlias' venue=$venue}
		{formField name='name' label={translate 'Name'}}
		{formAction action='Add' label={translate 'Hinzufügen'}}
	{/form}
</ul>
