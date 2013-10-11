<time class="currentDate"><span class="weekday">{date_weekday date=$date}</span>{date time=$date->getTimestamp()}</time>

{if $events->getCount()}
	<ul class="eventList">
		{foreach $events as $event}
			<li>
				{component name='Denkmal_Component_Event' event=$event}
			</li>
		{/foreach}
	</ul>
{else}
	<div class="noContent">
		<p>{button_link page="Denkmal_Page_Add" theme="highlight" icon="add" label="{translate 'Event hinzufügen'}"}</p>
	</div>
{/if}

