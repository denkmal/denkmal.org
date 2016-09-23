{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
  <header id="header">
    {if $viewer}
      <aside>
        {component name='Denkmal_Component_Logout'}
      </aside>
    {/if}
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="logo-symbol">{resourceFileContent path='img/logo-symbol.svg'}</span>
      <span class="logo-type">{resourceFileContent path='img/logo-type.svg'}</span>
    </a>
    {menu name='main' class='menu-header'}
  </header>
  <section id="middle">
    {$smarty.capture.pageContent}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
