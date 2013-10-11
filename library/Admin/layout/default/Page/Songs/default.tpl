{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Hinzufügen'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_SongAdd'}
	</div>
	<hr />
	{component name='Admin_Component_Filter_Search' searchTerm=$searchTerm urlPage='Admin_Page_Songs'}
	{component name='Admin_Component_SongList_All' searchTerm=$searchTerm}
{/block}
