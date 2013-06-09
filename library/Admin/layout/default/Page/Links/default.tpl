{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Hinzufügen'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_LinkAdd'}
	</div>
	{component name='Admin_Component_LinkList'}
{/block}
