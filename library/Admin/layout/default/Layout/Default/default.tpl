{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
  <header id="header">
    {if $viewer}
      <aside>
        {component name='Denkmal_Component_Logout'}
      </aside>
    {/if}
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="logo-icon">{resourceFileContent path='img/logo-icon.svg'}</span>
      <span class="logo-font">{resourceFileContent path='img/logo-font.svg'}</span>
    </a>
    {menu name='main' class='menu-header'}
  </header>
  <section id="middle">
    {$smarty.capture.pageContent}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
