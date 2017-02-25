{component name='Denkmal_Component_SongPlayer'}
<header id="header">
  <div class="sheet">
    {block name='header'}
      {component name='Denkmal_Component_HeaderBar'}
    {/block}
  </div>
</header>
<section id="middle" class="sheet">
  {page view=$page}
</section>
<div id="loading">
  {resourceFileContent path='img/logo-icon.svg'}
</div>
