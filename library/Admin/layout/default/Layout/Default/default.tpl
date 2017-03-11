<header id="header">
  <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
    <span class="logo-icon">{resourceFileContent path='img/logo-icon.svg'}</span>
    <span class="logo-font">{resourceFileContent path='img/logo-font.svg'}</span>
  </a>
  {menu name='main' class='menu-header'}
  {if $viewer}
    <aside>
      {component name='Denkmal_Component_Logout'}
    </aside>
  {/if}
</header>
<section id="middle">
  {page view=$page}
</section>
{component name='Denkmal_Component_SongPlayer'}
