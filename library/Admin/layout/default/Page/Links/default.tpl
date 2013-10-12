{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
	<div class="toggleNext">{translate 'Hinzufügen'}</div>
	<div class="toggleNext-content">
		{component name='Admin_Component_LinkAdd'}
	</div>
	<hr />
	{component name='Admin_Component_Filter_Search' searchTerm=$searchTerm urlPage='Admin_Page_Links'}
	{component name='Admin_Component_LinkList' searchTerm=$searchTerm}
{/block}
