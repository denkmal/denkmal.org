<ul class="eventList">
	{foreach $events as $event}
		<li>
			{component name='Denkmal_Component_Event' event=$event}
		</li>
	{/foreach}
</ul>
