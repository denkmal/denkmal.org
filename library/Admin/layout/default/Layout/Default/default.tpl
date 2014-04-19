{extends file=$render->getLayoutPath('Layout/Abstract/default.tpl', 'CM')}

{block name='body'}
  <header id="header">
    {if $viewer}
      {component name='Admin_Component_Logout'}
    {/if}
    {link icon="baslerstab" label="{$render->getSite()->getName()|escape}" page="Denkmal_Page_Index" class="logo toggleMenu"}
    {menu name='main'}
  </header>
  <section id="middle">
    {component name=$viewObj->getPage()}
  </section>
  {component name='Denkmal_Component_SongPlayer'}
{/block}
