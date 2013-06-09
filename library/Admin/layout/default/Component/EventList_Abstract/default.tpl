<ul>
	{foreach $eventList as $event}
		<li>
			{component name='Denkmal_Component_Event' event=$event}
		</li>
	{/foreach}
</ul>

{paging paging=$eventList ajax=true}
