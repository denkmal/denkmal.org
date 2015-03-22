{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Admin_Component_Filter_Search' searchTerm=$searchTerm urlPage='Admin_Page_Songs'}
  <div class="addNew">
    <div class="toggleNext">{translate 'Hinzufügen'}<span class="icon-plus"></span></div>
    <div class="toggleNext-content">
      {component name='Admin_Component_SongAdd'}
    </div>
  </div>
  {component name='Admin_Component_SongList_All' searchTerm=$searchTerm}
{/block}
