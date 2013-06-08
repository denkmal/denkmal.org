<ul>
	{foreach $venueList as $venue}
		<li>
			<a href="{linkUrl page='Admin_Page_Venue' venue={$venue->getId()}}">{$venue->getName()|escape}</a>
		</li>
	{/foreach}
</ul>
