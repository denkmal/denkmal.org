{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Bearbeiten'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_VenueEdit' venue=$venue}
	</div>

	<h2>{translate 'Anstehende Events'}</h2>
	{component name='Admin_Component_EventList_Venue' venue=$venue}
{/block}
