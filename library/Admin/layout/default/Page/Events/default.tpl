{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	{menu name='weekdays' template='weekdays'}

	events...
{/block}
