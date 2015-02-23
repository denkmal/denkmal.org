<ul class="tagList">
  <li class="tag toggleText">
    text
  </li>
  {foreach $tagListAvailable as $tag}
    <li class="tag {if in_array($tag->getId(), $tagIdList)}active{/if} toggleTag" data-id="{$tag->getId()|escape}">
      {img class='tag-image' path="tag/{$tag->getId()}.svg"}
    </li>
  {/foreach}
</ul>

<input type="hidden" name="{$name}" id="{$inputId}">
