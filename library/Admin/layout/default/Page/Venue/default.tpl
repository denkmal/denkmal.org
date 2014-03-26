{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}
{block name='content-main'}
  {component name='Admin_Component_Venue' venue=$venue}
  <h2>{translate 'Anstehende Veranstaltungen'}</h2>
  {component name='Admin_Component_EventList_Venue' venue=$venue}
{/block}
