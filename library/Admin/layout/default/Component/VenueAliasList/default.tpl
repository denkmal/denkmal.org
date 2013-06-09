<ul>
	{foreach $venueAliasList as $venueAlias}
		<li>
			{$venueAlias->getName()|escape}
		</li>
	{/foreach}
</ul>
