{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <div class="columns">
    <div class="column2">
      {component name='Admin_Component_Filter_Search' searchTerm=$searchTerm urlPage='Admin_Page_Links'}
      <div class="addNew">
        <div class="toggleNext">{translate 'Add'}<span class="icon-plus"></span></div>
        <div class="toggleNext-content">
          {component name='Admin_Component_LinkAdd'}
        </div>
      </div>
      {component name='Admin_Component_LinkList_All' searchTerm=$searchTerm}
    </div>
    <div class="column2">
      {component name='Admin_Component_LinkList_Broken' searchTerm=$searchTerm}
    </div>
  </div>
{/block}
