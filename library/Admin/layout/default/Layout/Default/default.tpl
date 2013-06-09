{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
	{menu name='main'}

	{component name=$viewObj->getPage()}
{/block}
