{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Edit'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_Venue' venue=$venue}
	</div>
{/block}
