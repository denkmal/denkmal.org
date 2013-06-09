{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	{menu name='weekdays' template='weekdays' class="clearfix"}

	{component name='Admin_Component_EventList_DateTime' date=$date}
{/block}
