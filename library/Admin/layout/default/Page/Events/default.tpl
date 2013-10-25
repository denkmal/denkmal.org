{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}
{block name='content-main'}
	<h2>{translate 'Veranstaltungen vom: {$date}' date="<time class=\"currentDate\"><span class=\"weekday\">{date_weekday date=$date}</span>{date time=$date->getTimestamp()}</time>"}</h2>
	{menu name='weekdays' template='weekdays' class="clearfix"}
	<div class="columns">
		<div class="column2">
			{component name='Admin_Component_VenueList_Queued' date=$date}
			{component name='Admin_Component_EventList_Queued' date=$date}
		</div>
		<div class="column2">
			<h2>{translate 'Veranstaltungen'}</h2>
			{component name='Admin_Component_EventList_DateTime' date=$date}
		</div>
	</div>
{/block}
