{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
	This is the admin layout

	{component name=$viewObj->getPage()}
{/block}
