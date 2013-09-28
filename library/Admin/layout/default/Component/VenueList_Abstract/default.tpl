<ul class="venueList">
	{foreach $venueList as $venue}
		<li class="venueList-item">
			{component name='Admin_Component_Venue' venue=$venue}
		</li>
	{/foreach}
</ul>

{paging paging=$venueList ajax=true}
