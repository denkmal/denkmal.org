{component name='Denkmal_Component_SongPlayer'}
{if $region}
  {component name='Denkmal_Component_PushNotifications' autoSubscribe=true}
{/if}
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
