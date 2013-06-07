{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
	This is the layout

	{component name=$viewObj->getPage()}
{/block}
