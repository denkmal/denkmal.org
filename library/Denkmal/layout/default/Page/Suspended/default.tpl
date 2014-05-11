{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}

{block name='content-main'}
  <div class="message">
    {translate '{$count} Tage bis zum Alltag' count="<span class='days-count'>{$suspension->getDaysLeft()}</span>"}
  </div>
  {if $song}
    <div class="song">
      {component name="Denkmal_Component_SongPlayerButton" song=$song autoPlay=$autoPlay}
    </div>
  {/if}
{/block}
