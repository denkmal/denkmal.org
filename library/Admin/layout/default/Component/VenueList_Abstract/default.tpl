<ul>
	{foreach $venueList as $venue}
		<li>
			{$venue->getName()|escape}
		</li>
	{/foreach}
</ul>
