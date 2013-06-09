{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	{menu name='weekdays' template='weekdays'}

	{component name='Admin_Component_EventList_DateTime' date=$date}
{/block}
