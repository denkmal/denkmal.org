<h2>Alias</h2>
<ul class="venueAliasList">
	{foreach $venueAliasList as $venueAlias}
		<li>
			{$venueAlias->getName()|escape}
		</li>
	{/foreach}
</ul>
{form name='Admin_Form_VenueAlias' venue=$venue}
	{formField name='name' label={translate 'Name'}}
	{formAction action='Add' label={translate 'Hinzufügen'}}
{/form}

