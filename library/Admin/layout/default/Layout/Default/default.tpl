{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
  <header id="header">
    {if $viewer}
      {component name='Denkmal_Component_Logout'}
    {/if}
    <a class="logo" href="{linkUrl page='Denkmal_Page_Index'}">
      <span class="baslerstab">{resourceFileContent path='img/logo-baslerstab.svg'}</span>
      <span class="denkmal">{resourceFileContent path='img/logo-denkmal.svg'}</span>
    </a>
    {menu name='main'}
  </header>
  <section id="middle">
    {$smarty.capture.pageContent}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
