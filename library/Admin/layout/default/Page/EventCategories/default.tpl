{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {foreach $eventCategoryList as $eventCategory}
    <div class="toggleNext">
      <span class="eventCategory-color" style="background-color:#{$eventCategory->getColor()->getHexString()};"></span>
      {$eventCategory->getLabel()|escape}
    </div>
    <div class="toggleNext-content">

    </div>
  {/foreach}
{/block}