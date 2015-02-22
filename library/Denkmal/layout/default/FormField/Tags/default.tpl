<ul class="tagList">
  {foreach $tagListAvailable as $tag}
    <li class="tagList-item {if in_array($tag->getId(), $tagIdList)}active{/if} toggleTag" data-id="{$tag->getId()|escape}">
      {$tag->getLabel()|escape}
    </li>
  {/foreach}
</ul>

<input type="hidden" id="{$inputId}" value="{$tagIdList|implode:','}">
