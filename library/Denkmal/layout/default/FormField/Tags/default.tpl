{strip}
  <ul class="tagList">
    <li class="tag tag-text toggleText">
      <a href="javascript:;" class="toggleTag">
        <div class="tag-image">{resourceFileContent path='img/icon/document2.svg'}</div>
      </a>
    </li>
    {foreach $tagListAvailable as $tag}
      <li class="tag {if in_array($tag->getId(), $tagIdList)}active{/if}" data-id="{$tag->getId()|escape}">
        <a href="javascript:;" class="toggleTag">
          {img class='tag-image' path="tag/{$tag->getLabel()}.svg"}
        </a>
      </li>
    {/foreach}
  </ul>
{/strip}

{if null !== $options.cardinality}
  <p class="cardinality-info">{translate '{$count} Sticker verfügbar' count="<span class='cardinality-left'>{$options.cardinality}</span>"}</p>
{/if}

<input type="hidden" name="{$name}" id="{$inputId}">
