{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Add'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_VenueAdd'}
	</div
	{component name='Admin_Component_VenueList_All'}
{/block}
