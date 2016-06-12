{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
  <header id="header">
    {if $viewer}
      <aside>
        {component name='Admin_Component_SelectRegion'}
        {component name='Denkmal_Component_Logout'}
      </aside>
    {/if}
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="logo-city">{resourceFileContent path='img/logo-city.svg'}</span>
      <span class="logo-denkmal">{resourceFileContent path='img/logo-denkmal.svg'}</span>
    </a>
    {menu name='main' class='menu-header'}
  </header>
  <section id="middle">
    {$smarty.capture.pageContent}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
