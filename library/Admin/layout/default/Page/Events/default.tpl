{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}
{block name='content-main'}
	<h2>Freizugebende Orte</h2>
	{component name='Admin_Component_VenueList_Queued' date=$date}

	<h2>Freizugebende Events</h2>
	{component name='Admin_Component_EventList_Queued' date=$date}

	<h2>Events</h2>
	{menu name='weekdays' template='weekdays' class="clearfix"}
	{component name='Admin_Component_EventList_DateTime' date=$date}
{/block}
