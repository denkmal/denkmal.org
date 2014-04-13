{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Admin_Component_Filter_Search' searchTerm=$searchTerm urlPage='Admin_Page_Venues'}
  {component name='Admin_Component_VenueList_All' searchTerm=$searchTerm}
{/block}
