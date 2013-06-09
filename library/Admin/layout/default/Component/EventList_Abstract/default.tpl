<ul>
	{foreach $eventList as $event}
		<li>
			{$event->getDescription()|escape}
		</li>
	{/foreach}
</ul>
